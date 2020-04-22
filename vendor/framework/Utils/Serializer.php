<?php

namespace framework\Utils;

trait Serializer
{
    public function LoadFromJson($json)
    {
        foreach ($json as $key => $value) {
            if (is_array($value)) {
                $subObjClass = get_class($this->{$key});
                $subObj = new $subObjClass();
                $subObj->LoadFromJson($value);
                $value = $subObj;
            }
            $this->{$key} = $value;
        }
    }
}
