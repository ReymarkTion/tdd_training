<?php

function create($class, $attributes = [], $count = null)
{
    return factory($class, $count)->create($attributes);
}

function make($class, $attributes = [], $count = null)
{
    return factory($class, $count)->make($attributes);
}

function raw($class, $attributes = [], $count = null)
{
    return factory($class, $count)->raw($attributes);
}
