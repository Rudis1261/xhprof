<?php

/**
 * @author          Rudi Strydom <iam@thatguy.co.za>
 * @datetime        July 2014
 * @description     Second attempt at a magnification class.
 * This will be self contained, to replace merger and cache.
 */
class Compost
{
    public $type      = '';
    public $files     = ["header" => [], "footer" => []];
    public $inputDir  = '';
    public $coreDir   = '';
    public $outputDir = '';
    public $uri       = '';
    public $output    = '';
    public $hash      = ["header" => '', "footer" => ''];
    public $heap      = ["header" => '', "footer" => ''];
    public $debug     = false;
    public $rendered  = ["header" => false, "footer" => false];


    function __construct() {
        if ($this->debug) error_reporting(-1);
        if ($this->debug) ini_set("display_errors", 1);
    }


    // Add more files to compose
    public function add($file=false, $location="footer")
    {
        // Ensure we have something to work with
        if (!empty($file)) {

            // Try to init should the construct not have contained an output
            $this->init($file);
            $this->files[$location][] = $file;
            $fileContent              = file_get_contents($this->inputDir . "/" . $file);
            $this->heap[$location]   .= $fileContent;
        }

        if ($this->debug) echo("ADDING (" . $file . "): " . strlen($this->heap[$location]) . "<br />");
        return false;
    }

    // Add more files to compose
    public function addCore($file=false, $location="footer")
    {
        // Ensure we have something to work with
        if (!empty($file)) {

            // Try to init should the construct not have contained an output
            $this->init($file);
            $this->files[$location][] = $file;
            $fileContent              = file_get_contents($this->coreDir . "/" . $file);
            $this->heap[$location]   .= $fileContent;
        }

        if ($this->debug) echo("ADDING (" . $file . "): " . strlen($this->heap[$location]) . "<br />");
        return false;
    }


    // Adding render function to compile and hash the style
    public function render($location="footer")
    {
        $output = '';
        if (! $this->rendered[$location]) {

            if ($this->debug) var_dump("RENDERING START");

            $this->heap[$location]     = $this->miniFy($this->heap[$location]);
            $this->hash[$location]     = md5($this->heap[$location]);
            $output                   .= $this->write($location);
            $this->rendered[$location] = true;

            if ($this->debug) var_dump("RENDERING COMPLETE");
        }
        return $output;
    }


    public function compile($location="footer"){

        // Render if it's not yet rendered
        if (! $this->rendered[$location]) {
            $this->render($location);
        }

        // Get the paths
        $normal = $this->paths('uri', $location);
        $minified = $this->paths('min', $location);

        // Check that the input file exists and that we are dealing with JS
        if (!file_exists($normal) || !$this->type == "js") {
            return false;
        }

        // Minified exists already
        if (file_exists($minified)) {
            return "exists";
        }

        $command = "/usr/bin/java -jar compiler.jar --compilation_level ADVANCED_OPTIMIZATIONS \
--js {$normal} \
--js_output_file {$minified} \
--jscomp_off=internetExplorerChecks \
--warning_level=QUIET";

        exec($command, $output, $stdOut);
        if ($stdOut <= 1) {
            return true;
        }

        if ($this->debug) var_dump($output);

        throw new Exception("Compile failed STDOUT: ".$stdOut, 1);
        return false;
    }


    // Provide the file as is
    public function raw($location="footer")
    {
        // Attempt to write the compost pile / heap
        return $this->miniFy($this->heap[$location]);
    }


    // Write the css / js to file for referencing
    public function write($location="footer")
    {
        if ($this->debug) var_dump("WRITING");

        $output = '';

        // Ensure that we have something to work with
        if (! empty($this->heap[$location]))
        {
            // This file has already been written, no need to re-write it again
            if (! file_exists($this->paths('local', $location))){

                if ($this->debug) var_dump("WRITING FILE");

                // Set the local file as well as the relative file
                $writen = file_put_contents(
                    $this->paths('local', $location),
                    $this->heap[$location]
                );

                // Ensure that we were able to write the content to the filesystem
                if ($writen !== false) {
                    return $this->paths('uri', $location);
                }
            }
        }

        // Return either empty or the file name
        return $output;
    }


    // We may also only want the filename itself
    public function paths($specific=false, $location="footer")
    {
        $paths[$location] = array(
            "local" => $this->outputDir . "/" . $this->hash[$location] . "." . $this->type,
            "uri"   => $this->uri . "/" . $this->hash[$location] . "." . $this->type,
            "min"   => $this->uri . "/" . $this->hash[$location] . ".min." . $this->type
        );

        // Over ride with the .min files
        $paths[$location]['uri'] = $this->minified(
            $paths[$location]['local'],
            $paths[$location]['uri']
        );

        if ($specific !== false) {
            return $paths[$location][$specific];
        }
        return $paths[$location];
    }


    /**
     * This method is used to check whether the server-side minification has run
     */
    public function minified($local, $url)
    {
        if (! empty($this->type)) {
            $minified_local = str_replace(
                "." . $this->type,
                ".min." . $this->type,
                $local
            );

            if (file_exists($minified_local)) {
                return str_replace(
                    "." . $this->type,
                    ".min." . $this->type,
                    $url
                );
            }
        }
        return $url;
    }


    // Get the Url should we not have used the
    public function url($location="footer")
    {
        if (! $this->rendered[$location]) {
            $this->render($location);
        }
        return $this->paths('uri', $location);
    }


    // We need to clean out comments to save space
    // I would like to minify the CSS and JS a bit more
    public function miniFy($content)
    {
        $find       = array("\r", "\t");
        $replace    = array("\n", "");
        $content    = str_replace($find, $replace, $content);
        $lines      = explode("\n", $content);
        $newContent = array();

        foreach($lines as $lid => $line) {
            $line = trim($line);

            // Remove lines with // Comments
            if (substr($line, 0, 2) == "//") continue;

            // Remove lines with /* */ Comments
            if ((substr($line, 0, 2) == "/*") AND (substr($line, (strlen($line) - 2)) == "*/")) continue;

            // Site URL in double curleys
            if (stristr($line, '{{SITE_URL}}')) $line = str_replace('{{SITE_URL}}', SITE_URL, $line);

            // IMG url in double curleys
            if (stristr($line, '{{IMG}}')) $line = str_replace('{{IMG}}', IMG, $line);

            // Ensure that the line still has contents
            if (!empty($line)) {
                $newContent[] = $line;
            }
        }

        $content = implode("\n", $newContent);
        return $content;
    }


    public function getDepth()
    {
        // Otherwise let's get the URI and split it up
        if (! empty($_SERVER['REQUEST_URI'])) {
            $getCount = substr_count($_SERVER['REQUEST_URI'], '/');

            // Ensure that there was a slash at least
            if ($getCount > 0) {
                $test = str_repeat("../", ($getCount - 1));
                return $test;
            }
        }
        return "";
    }


    // We would like to be able to initialize the details
    public function init($file)
    {
        // Do we have a type yet?
        if (empty($this->type) AND pathinfo($file, PATHINFO_EXTENSION) !== false) {

            // We can only set these once we have a file to work with
            $this->type      = pathinfo($file, PATHINFO_EXTENSION);
            $this->inputDir  = PWD . "/assets/" . $this->type;
            $this->coreDir   = CORE_ROOT . "/assets/" . $this->type;
            $this->outputDir = PWD . "/assets/" . $this->type . "/out";
            $this->uri       = $this->getDepth() . "assets/" . $this->type . "/out";
        }
    }


    // Aliases
    public function addFile($file =false)    { return $this->add($file); }
    public function uri($location ="footer") { return $this->url($location); }
}
