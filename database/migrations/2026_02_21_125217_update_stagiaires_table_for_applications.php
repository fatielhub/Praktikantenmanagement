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
        Schema::table('stagiaires', function (Blueprint $table) {
            $table->string('universite')->nullable()->after('filiere');
            $table->text('message')->nullable()->after('universite');
            $table->string('cv_path')->nullable()->after('message');
            $table->string('motivation_letter_path')->nullable()->after('cv_path');
            $table->string('cni_copy_path')->nullable()->after('motivation_letter_path');
            $table->string('insurance_certificate_path')->nullable()->after('cni_copy_path');
            $table->string('signed_convention_path')->nullable()->after('insurance_certificate_path');
            $table->text('refusal_reason')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stagiaires', function (Blueprint $table) {
            $table->dropColumn([
                'universite',
                'message',
                'cv_path',
                'motivation_letter_path',
                'cni_copy_path',
                'insurance_certificate_path',
                'signed_convention_path',
                'refusal_reason'
            ]);
        });
    }
};
