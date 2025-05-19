<?php

function checkFilter($object)
{
    $query = $object->filter();
    checkQuery($query, 'Mali and models mo (filter).');
    return $query;
}

function checkFilterSearch($object)
{
    $query = $object->filterSearch();
    checkQuery($query, 'Mali and models mo (filter search).');
    return $query;
}
