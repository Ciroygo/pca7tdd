<?php

function create($class, $attribute = [], $times = null)
{
    return factory($class, $times)->create($attribute);
}

function make($class, $attribute = [], $times = null)
{
    return factory($class, $times)->make($attribute);
}

function raw($class, $attribute = [], $times = null)
{
    return factory($class, $times)->raw($attribute);
}
