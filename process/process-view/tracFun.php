<?php 

function getTraceabilityByDate($date){
    $db = connectdb();
    $query = "SELECT num, product, packaging, state FROM traceability";
}