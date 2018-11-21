<?php

/**
 *   ___       _
 *  / _ \  ___| |_ ___  _ __  _   _
 * | | | |/ __| __/ _ \| '_ \| | | |
 * | |_| | (__| || (_) | |_) | |_| |
 *  \___/ \___|\__\___/| .__/ \__, |
 *                     |_|    |___/
 * @author  : Supian M <supianidz@gmail.com>
 * @version : v1.0
 * @license : MIT
 */

Schema::create('costumers', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name', 100);
    $table->string('phone', 50);
    $table->enum('account', ['AGM Chargable Job', 'OKI Warranty']);
    $table->string('job_No', 20);
    $table->string('company_name', 100);
    $table->string('contact_name', 100);
    $table->string('printer_model', 100);
    $table->string('printer_serial', 100);
    $table->string('page_count_mono', 100);
    $table->string('page_count_colour', 100);
    $table->text('service_notes');
    $table->enum('status', ['FINISHED', 'PARTS', 'QUOTE', 'CANCEL']);
});

Schema::create('attachments', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('costumer_id')->unsigned();
    $table->foreign('costumer_id')->references('id')->on('costumers');
    $table->string('file_name', 100);
    $table->enum('type', ['signature', 'other']);
});
