<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
            "ex_name",
            "ex_address",
            "con_name",
            "con_full_address",
            "con_country",
            "dep_date",
            "vessels_name",
            "port_of_discharge",
            "country_destination",
            "country_origin",
            "certificate_origin_no",
            "signature_1",
            "name",
            "designation",
            "date_1",
            "h_s_code",
            "quantity_unit",
            "signature_2",
            "date_2",
            "serialno",
            "marksno",
            "package"
    ];

}
