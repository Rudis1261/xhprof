<?php
    class ioLooped
    {
        public $file;
        function __construct($logName) {
            $this->file = $logName;
        }
        // Opens a handler, writes and closes file
        function write($line) {
            $fh = fopen($this->file, 'a');
            fwrite($fh, $line . PHP_EOL);
            fclose($fh);
        }
    }
    function ioLoopedTest() {
        $ts = time();
        $filename = "/tmp/ioLooped.{$ts}.log";
        $log = new ioLooped($filename);
        $i = 1;
        while($i <= 100000) {
            $log->write("Writing line {$i}");
            $i++;
        }
        var_dump(file_get_contents($filename));
    }
    ioLoopedTest();