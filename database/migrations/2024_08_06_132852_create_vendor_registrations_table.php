<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('subject')->nullable(true);
            $table->string('vendor_name')->nullable(true);
            $table->string('legal_name')->nullable(true);
            $table->string('street_no')->nullable(true);
            $table->string('city')->nullable(true);
            $table->string('country_name')->nullable(true);
            $table->string('telephone_number')->nullable(true);
            $table->string('mobile_number1')->nullable(true);
            $table->string('contact_person1')->nullable(true);
            $table->string('mobile_number2')->nullable(true);
            $table->string('contact_person2')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('gst_number')->nullable(true);
            $table->string('pan_number')->nullable(true);
            $table->string('msme_number')->nullable(true);
            $table->string('fssai_number')->nullable(true);
            $table->string('rtv_expiry')->nullable(true);
            $table->string('rtv_damage')->nullable(true);
            $table->string('payment_cycle')->nullable(true);
            $table->string('credit_day')->nullable(true);
            $table->string('cancelled_cheque')->nullable(true);
            $table->string('beneficiary_name')->nullable(true);
            $table->string('bank_name')->nullable(true);
            $table->string('bank_address')->nullable(true);
            $table->string('postal_zip_code')->nullable(true);
            $table->string('bank_country_name')->nullable(true);
            $table->string('beneficiary_account_type')->nullable(true);
            $table->string('beneficiary_account_name')->nullable(true);
            $table->string('beneficiary_account_number')->nullable(true);
            $table->string('branch_micr_code')->nullable(true);
            $table->string('branch_ifsc_code')->nullable(true);
            $table->string('listing_charges')->nullable(true);
            $table->string('q_mart_retail')->nullable(true);
            $table->string('description')->default('Vendor Registration');
            $table->string('vendor_remark')->nullable(true);
            $table->string('approved_by')->nullable(true);
             $table->string('entered_by')->nullable(true);
            $table->string('status')->default('Pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_registrations');
    }
};
