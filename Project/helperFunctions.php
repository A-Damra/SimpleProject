<?php
function FormatedDates($date) : string
{
    return Date("M d, Y", strtotime($date));
}

//remove the $ sign and cast to float;
function FormatTransaction($amount) : float {
    return (float)str_replace(['$', ','], "", $amount);
}

