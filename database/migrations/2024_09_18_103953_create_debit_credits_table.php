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
        Schema::create('debit_credits', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(true);
            $table->string('gst_number')->nullable(true);
            $table->string('vendor_document')->nullable(true);
            $table->string('admin_document')->nullable(true);
            $table->string('vendor_amount')->nullable(true);
            $table->string('admin_amount')->nullable(true);
            $table->string('vendor_name')->nullable(true);
            $table->text('vendor_message')->nullable(true);
            $table->string('admin_message')->nullable(true);
            $table->string('vendor_file')->nullable(true);
            $table->string('admin_file')->nullable(true);
            $table->string('description')->default('Debit/Credit Note');
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
        Schema::dropIfExists('debit_credits');
    }
};
