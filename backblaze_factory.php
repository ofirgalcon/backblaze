<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Backblaze_model::class, function (Faker\Generator $faker) {
    $files = $faker->numberBetween(1000, 250000);
    $bytes = $faker->numberBetween(5_000_000_000, 500_000_000_000);
    $remainingFiles = $faker->numberBetween(0, (int) ($files * 0.05));
    $remainingBytes = $faker->numberBetween(0, (int) ($bytes * 0.05));

    return [
        'bzversion' => $faker->randomElement(['9.0.0.790', '9.1.0.812', '8.5.0.754']),
        'bzlogin' => 'demo.user@example.invalid',
        'bzlicense' => $faker->randomElement(['biz', 'personal', 'trial']),
        'bzlicense_status' => $faker->randomElement(['good', 'good', 'good', 'expired']),
        'safety_frozen' => $faker->boolean(10),
        'lastbackupcompleted' => (int) $faker->dateTimeBetween('-7 days')->format('U'),
        'remainingnumfilesforbackup' => $remainingFiles,
        'remainingnumbytesforbackup' => $remainingBytes,
        'totnumbytesforbackup' => $bytes,
        'totnumfilesforbackup' => $files,
        'encrypted' => $faker->boolean(80),
        'online_hostname' => 'demo-mac',
        'bztempfile_size' => $faker->numberBetween(0, 50_000_000),
    ];
});
