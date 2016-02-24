<?php
    class ioConstruct
    {
        static $file; // Static? Because I can has it
        function __construct($logName) {
            self::$file = fopen($logName, 'a');
        }
        function write($line) {
            fwrite(self::$file, $line . PHP_EOL);
        }
        function __destruct() {
            fclose(self::$file);
        }
    }
    function ioConstructedTest() {
        $ts = time();
        $filename = "/tmp/ioConstructed.{$ts}.log";
        $log = new ioConstruct($filename);
        $i = 1;
        while($i <= 100000) {
            $log->write("Writing line {$i}");
            $i++;
        }
        var_dump(file_get_contents($filename));
    }
    ioConstructedTest();