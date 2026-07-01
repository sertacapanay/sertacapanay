<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;

/**
 * Pegasus BolBol (BolPuan) hesap geçmişinden çıkarılan gerçek uçuş kayıtları.
 * flypgs.com "BolPuan Dökümü" sayfasında 24 Temmuz 2018 (üyeliğin BolPuan
 * geçmişinin başlangıcı, öncesi görüntülenemiyor) ile bugün arasındaki 45
 * günlük tüm dönemler tek tek tarandı; sadece "Pegasus Kazanım detaylarına
 * ulaşmak için tıklayınız" altında listelenen ve itemize edilmiş gerçek uçuş
 * satırları alındı. Kampanya/kart bonusu niteliğindeki "Ek Pegasus
 * Kazanımları" ve harcama (ödül bileti/redemption) satırları uçuş olmadığı
 * için hariç tutuldu. Mesafeler (km) havalimanı koordinatlarından büyük
 * daire (haversine) hesabıyla türetildi; kuş uçuşu mesafedir. Eskiden yeniye
 * kronolojik sırayla eklenir. Türk Hava Yolları (Miles&Smiles) kayıtlarından
 * ayrı bir havayolu (Pegasus) olarak işaretlendi.
 */
class PegasusFlightImportSeeder extends Seeder
{
    public function run(): void
    {
        $flights = [
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2018-08-18', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Gazipaşa', 'flight_date' => '2018-08-28', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Kopenhag', 'flight_date' => '2018-09-02', 'airline' => 'Pegasus', 'distance_km' => 2038, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Kopenhag', 'to_city' => 'İstanbul', 'flight_date' => '2018-09-09', 'airline' => 'Pegasus', 'distance_km' => 2038, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Ankara', 'to_city' => 'İstanbul', 'flight_date' => '2018-10-02', 'airline' => 'Pegasus', 'distance_km' => 323, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Ankara', 'flight_date' => '2018-10-02', 'airline' => 'Pegasus', 'distance_km' => 323, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Ankara', 'to_city' => 'İstanbul', 'flight_date' => '2018-11-22', 'airline' => 'Pegasus', 'distance_km' => 323, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Ankara', 'flight_date' => '2018-11-22', 'airline' => 'Pegasus', 'distance_km' => 323, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2019-07-04', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Gazipaşa', 'flight_date' => '2019-07-17', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Brüksel', 'flight_date' => '2019-10-18', 'airline' => 'Pegasus', 'distance_km' => 2189, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2022-04-09', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2022-05-26', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Kopenhag', 'flight_date' => '2022-09-11', 'airline' => 'Pegasus', 'distance_km' => 2038, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Milano', 'to_city' => 'İstanbul', 'flight_date' => '2022-09-22', 'airline' => 'Pegasus', 'distance_km' => 1668, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2022-10-27', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2022-12-27', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Gazipaşa', 'flight_date' => '2022-12-29', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Hamburg', 'flight_date' => '2023-09-20', 'airline' => 'Pegasus', 'distance_km' => 2020, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Milano', 'to_city' => 'İstanbul', 'flight_date' => '2023-10-02', 'airline' => 'Pegasus', 'distance_km' => 1668, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Milano', 'to_city' => 'İstanbul', 'flight_date' => '2023-10-16', 'airline' => 'Pegasus', 'distance_km' => 1668, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Gazipaşa', 'flight_date' => '2023-10-18', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Antalya', 'to_city' => 'İstanbul', 'flight_date' => '2023-11-17', 'airline' => 'Pegasus', 'distance_km' => 463, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2024-01-25', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Gazipaşa', 'flight_date' => '2024-02-16', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2024-03-14', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Gazipaşa', 'flight_date' => '2024-03-16', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Marsilya', 'flight_date' => '2024-04-07', 'airline' => 'Pegasus', 'distance_km' => 1998, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2024-04-27', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'İzmir', 'flight_date' => '2024-04-28', 'airline' => 'Pegasus', 'distance_km' => 343, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Kopenhag', 'to_city' => 'Antalya', 'flight_date' => '2024-05-13', 'airline' => 'Pegasus', 'distance_km' => 2489, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2024-05-17', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2024-06-15', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Gazipaşa', 'flight_date' => '2024-07-01', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2024-08-31', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Kopenhag', 'flight_date' => '2024-09-01', 'airline' => 'Pegasus', 'distance_km' => 2038, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Kopenhag', 'to_city' => 'İstanbul', 'flight_date' => '2024-09-11', 'airline' => 'Pegasus', 'distance_km' => 2038, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Gazipaşa', 'flight_date' => '2024-10-03', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Antalya', 'to_city' => 'İstanbul', 'flight_date' => '2025-06-23', 'airline' => 'Pegasus', 'distance_km' => 463, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Kopenhag', 'flight_date' => '2025-07-20', 'airline' => 'Pegasus', 'distance_km' => 2038, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Kopenhag', 'to_city' => 'İstanbul', 'flight_date' => '2025-07-27', 'airline' => 'Pegasus', 'distance_km' => 2038, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Gazipaşa', 'flight_date' => '2025-07-29', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Antalya', 'to_city' => 'Bakü', 'flight_date' => '2025-08-18', 'airline' => 'Pegasus', 'distance_km' => 1713, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Bakü', 'to_city' => 'Antalya', 'flight_date' => '2025-08-21', 'airline' => 'Pegasus', 'distance_km' => 1713, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Kopenhag', 'flight_date' => '2025-08-31', 'airline' => 'Pegasus', 'distance_km' => 2038, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Kopenhag', 'to_city' => 'İstanbul', 'flight_date' => '2025-09-07', 'airline' => 'Pegasus', 'distance_km' => 2038, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'Gazipaşa', 'to_city' => 'İstanbul', 'flight_date' => '2026-03-10', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
            ['from_city' => 'İstanbul', 'to_city' => 'Gazipaşa', 'flight_date' => '2026-03-24', 'airline' => 'Pegasus', 'distance_km' => 574, 'notes_tr' => 'BolPuan kaydından', 'notes_en' => 'From BolPuan record'],
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }
}
