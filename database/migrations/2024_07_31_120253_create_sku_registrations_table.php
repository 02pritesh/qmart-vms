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
        Schema::create('sku_registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('subject')->nullable(true);
            $table->string('description')->default('Sku Registration');
            $table->string('gst_number')->nullable(true);
            $table->string('vendor_name')->nullable(true);
            $table->string('product_name')->nullable(true);
            $table->string('category')->nullable(true);
            $table->string('rtv')->nullable(true);
            $table->string('unit')->nullable(true);
            $table->integer('case_qty')->nullable(true);
            $table->string('EAN_Code')->nullable(true);
            $table->string('shelf_life')->nullable(true);
            $table->string('HSN_Code')->nullable(true);
            // $table->string('CGST_Code')->nullable(true);
            // $table->string('SGST_Code')->nullable(true);
            // $table->string('IGST_Code')->nullable(true);
            $table->string('cess_percentage')->nullable(true);
            $table->integer('cess')->nullable(true);
            $table->string('additional_cess')->nullable(true);
            $table->string('gst_percentage')->nullable(true);
            $table->integer('margin_percentage')->nullable(true);
            $table->string('mrp')->nullable(true);
            $table->string('margin')->nullable(true);
            $table->string('landing_price')->nullable(true);
            $table->integer('gst_price')->nullable(true);
            $table->string('basic_cost')->nullable(true);
            $table->string('sku_remark')->nullable(true);
            $table->string('erp_code')->nullable(true);
            $table->string('approved_by')->nullable(true);
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
        Schema::dropIfExists('sku_registrations');
    }
};
