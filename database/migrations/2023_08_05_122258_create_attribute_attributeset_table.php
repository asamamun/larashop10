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
        Schema::create('attribute_attributeset', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attributeset_id')->unsigned();
            $table->foreign('attributeset_id')->references('id')->on('attributesets')->onDelete('cascade');
			$table->bigInteger('attribute_id')->unsigned();
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
			$table->boolean('filterable')->default(0);
			$table->boolean('searchable')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_attributeset');
    }
};
