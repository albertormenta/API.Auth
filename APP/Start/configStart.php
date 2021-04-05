<?php
namespace Start;

class configStart
{
        protected $FileJsonConfig = "JsonConfig.json";
        protected $Folder = "\\Config\\";

        public function dir()
        {
                return dirname(__FILE__, 2);
        }

        public function GetDataConfig($Connection)
        {
                $JsonConfig = $this->dir() . $this->Folder . $this->FileJsonConfig;
                $content = file_get_contents($JsonConfig);
                $result = json_decode($content, true);

                return $result[$Connection];
        }
}
