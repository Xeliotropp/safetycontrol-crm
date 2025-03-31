<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // id with AUTO_INCREMENT
            $table->date('dateOfMeasurement')->nullable();
            $table->tinyInteger('mk')->default(0);
            $table->tinyInteger('osv')->default(0);
            $table->tinyInteger('sh')->default(0);
            $table->tinyInteger('vent')->default(0);
            $table->tinyInteger('klim')->default(0);
            $table->tinyInteger('f0')->default(0);
            $table->tinyInteger('z')->default(0);
            $table->tinyInteger('m')->default(0);
            $table->tinyInteger('izol')->default(0);
            $table->tinyInteger('dtz')->default(0);
            $table->string('wayOfShowingDocumentation')->nullable();
            $table->string('certificateNumber')->nullable();
            $table->date('certificateDate')->nullable();
            $table->date('nextMeasurement')->nullable();
            $table->tinyInteger('mkNext')->default(0);
            $table->tinyInteger('osvNext')->default(0);
            $table->tinyInteger('shNext')->default(0);
            $table->tinyInteger('ventNext')->default(0);
            $table->tinyInteger('klimNext')->default(0);
            $table->tinyInteger('f0Next')->default(0);
            $table->tinyInteger('zNext')->default(0);
            $table->tinyInteger('mNext')->default(0);
            $table->tinyInteger('izolNext')->default(0);
            $table->tinyInteger('dtzNext')->default(0);
            $table->string('invoice')->nullable();
            $table->string('payment_method')->nullable();
            $table->date('invoice_date')->nullable();
            $table->double('price_without_vat')->nullable();
            $table->tinyInteger('paid')->default(0);
            $table->double('contragent_sum')->nullable();
            $table->double('total_sum')->nullable();
            $table->unsignedBigInteger('client_id')->onDelete('cascade'); //->nullable()
            $table->unsignedBigInteger('contragent_id')->nullable();
            $table->string('contragent')->nullable();
            $table->tinyInteger('mkcold')->default(0);
            $table->tinyInteger('osvEvak')->default(0);
            $table->tinyInteger('shobSgr')->default(0);
            $table->tinyInteger('shokolSr')->default(0);
            $table->tinyInteger('mkcoldNext')->default(0);
            $table->tinyInteger('osvEvakNext')->default(0);
            $table->tinyInteger('shobSgrNext')->default(0);
            $table->tinyInteger('shokolSrNext')->default(0);
            $table->text('courrierDetails')->nullable();
            $table->timestamps(); // created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
