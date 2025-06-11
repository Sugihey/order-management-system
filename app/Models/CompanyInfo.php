<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $table = 'company_info';
    
    protected $fillable = [
        'name',
        'zip',
        'address',
        'email',
        'phone_no',
        'fax_no',
        'invoice_no',
        'bank_name',
        'bank_branch',
        'account_type',
        'account_name'
    ];
}
