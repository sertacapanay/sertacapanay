<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin kullanıcı ──────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'sertac@hotmail.com'],
            [
                'name'              => 'Sertaç Apanay',
                'password'          => Hash::make(env('ADMIN_PASSWORD', Str::random(32))),
                'email_verified_at' => now(),
            ]
        );

        // ── Ürünler (Products) ───────────────────────────────────────
        $products = [
            [
                'title_tr'        => 'El Dokuması İkat Atkı',
                'title_en'        => 'Handwoven Ikat Scarf',
                'slug'            => 'el-dokumasi-ikat-atki',
                'category_tr'     => 'tekstil',
                'category_en'     => 'apparel',
                'source_place_tr' => 'Ubud, Bali',
                'source_place_en' => 'Ubud, Bali',
                'price'           => 95.00,
                'currency'        => '$',
                'image'           => null,
                'description_tr'  => 'Bali\'nin Ubud bölgesinde yerel dokumacılar tarafından geleneksel ikat tekniğiyle elle dokunmuş bu atkı, her birinin kendine özgü deseni olan eşsiz bir el sanatı ürünüdür.',
                'description_en'  => 'Handwoven by local artisans in Ubud, Bali using the traditional ikat technique, this scarf is a unique piece of craftsmanship where each one carries its own distinct pattern.',
                'is_active'       => true,
            ],
            [
                'title_tr'        => 'Zellige Seramik Kâse',
                'title_en'        => 'Zellige Ceramic Bowl',
                'slug'            => 'zellige-seramik-kase',
                'category_tr'     => 'el sanatı',
                'category_en'     => 'local crafts',
                'source_place_tr' => 'Marakeş, Fas',
                'source_place_en' => 'Marrakech, Morocco',
                'price'           => 52.00,
                'currency'        => '$',
                'image'           => null,
                'description_tr'  => 'Geleneksel Fas zellige desenleriyle elle boyanmış seramik kâse. 10. yüzyıla uzanan tekniklerle yapıldı. Marakeş\'in çömlekçiler mahallesinde bir sabah boyunca ustanın elinden çıktı.',
                'description_en'  => 'Hand-painted ceramic bowl featuring traditional Moroccan zellige patterns. Made using techniques dating back to the 10th century, crafted in the pottery quarter of Marrakech.',
                'is_active'       => true,
            ],
            [
                'title_tr'        => 'Antika Pirinç Pusula',
                'title_en'        => 'Vintage Brass Compass',
                'slug'            => 'antika-princ-pusula',
                'category_tr'     => 'aksesuar',
                'category_en'     => 'accessories',
                'source_place_tr' => 'İstanbul, Türkiye',
                'source_place_en' => 'Istanbul, Turkey',
                'price'           => 145.00,
                'currency'        => '$',
                'image'           => null,
                'description_tr'  => 'İstanbul\'un tarihi Kapalıçarşı\'sından derlenen bu pirinç pusula, denizcilik geleneğinin zarif bir hatırası. Her gezginin masasında ya da cebinde taşıyabileceği zamansız bir parça.',
                'description_en'  => 'Sourced from Istanbul\'s historic Grand Bazaar, this brass compass is an elegant memento of maritime tradition — a timeless piece for any traveler\'s desk or pocket.',
                'is_active'       => true,
            ],
            [
                'title_tr'        => 'El Yapımı Deri Seyahat Defteri',
                'title_en'        => 'Artisan Leather Travel Journal',
                'slug'            => 'el-yapimi-deri-seyahat-defteri',
                'category_tr'     => 'aksesuar',
                'category_en'     => 'accessories',
                'source_place_tr' => 'Fez, Fas',
                'source_place_en' => 'Fez, Morocco',
                'price'           => 68.00,
                'currency'        => '$',
                'image'           => null,
                'description_tr'  => 'Fas\'ın antik kenti Fez\'de atölyelerde, geleneksel deri işleme yöntemleriyle üretilen bu seyahat defteri, her anın kaydedilmeyi hak ettiğine inanan gezginler için yapılmış.',
                'description_en'  => 'Made in the workshops of Fez, Morocco\'s ancient city, using traditional leather craft methods. This travel journal is made for travelers who believe every moment deserves to be recorded.',
                'is_active'       => true,
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(
                ['slug' => $product['slug']],
                array_merge($product, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // ── Blog Yazıları (Posts) ────────────────────────────────────
        $posts = [
            [
                'title_tr'      => 'Her Gezgin Yurt Dışında Yemek Yapmayı Öğrenmeli',
                'title_en'      => 'Why Every Traveler Should Learn to Cook Abroad',
                'slug'          => 'her-gezgin-yurt-disinda-yemek-yapmayi-ogrenmeli',
                'category_tr'   => 'yemek',
                'category_en'   => 'food',
                'cover_image'   => null,
                'excerpt_tr'    => 'Asıl müze, pazarın kendisi. Yerel mutfağı öğrenmek seni turistten geçici bir sakine dönüştürür.',
                'excerpt_en'    => 'The market is the real museum. Learning to cook local cuisine transforms you from tourist to temporary resident.',
                'content_tr'    => '<p>Seyahat ettiğimiz her yerde mutfak, o kültürün en dürüst aynasıdır. Bir şehrin ruhunu anlamak istiyorsanız restoranlarına değil, pazarlarına gidin.</p><p>Yerel bir mutfak dersi almak ya da ev sahibinizin sofrasında oturmak, hiçbir rehber kitabının anlatamayacağı hikâyeler açar önünüzde. Baharat tezgâhları, balık pazarları, ekmek fırınları — bunlar birer müzedir aslında.</p><p>Bir şefi izlemek, malzemeleri dokunarak seçmek ve o akşam pişirdiğinizi birlikte yemek, o şehirle kurduğunuz en derin bağdır. Dönüşünüzde bir anı değil, bir beceri taşırsınız yanınızda.</p>',
                'content_en'    => '<p>In every place we travel, the kitchen is the most honest mirror of that culture. If you want to understand a city\'s soul, go to its markets, not its restaurants.</p><p>Taking a local cooking class or sitting at your host\'s table opens stories that no guidebook can tell. Spice stalls, fish markets, bread ovens — these are museums in themselves.</p><p>Watching a chef, selecting ingredients by touch, and eating together what you\'ve cooked that evening — that is the deepest connection you can make with a city. When you return, you carry not just a memory, but a skill.</p>',
                'is_published'  => true,
                'published_at'  => now()->subDays(5),
            ],
            [
                'title_tr'      => 'Destinasyonlar Arasındaki Sessizlik',
                'title_en'      => 'The Silence Between Destinations',
                'slug'          => 'destinasyonlar-arasindaki-sessizlik',
                'category_tr'   => 'seyahat hikâyeleri',
                'category_en'   => 'travel stories',
                'cover_image'   => null,
                'excerpt_tr'    => 'Seyahat, vardığın yerlerle değil; kalkış ile varış arasındaki o dönüştürücü boşlukla ilgilidir.',
                'excerpt_en'    => 'Travel isn\'t about the places you arrive at — it\'s about the transformative space between departure and arrival.',
                'content_tr'    => '<p>Her uçuş arasında, her tren yolculuğunun ortasında, her uzun otobüs seferinin belirsiz saatlerinde bir şey olur: düşünürsünüz.</p><p>Kalabalık bir şehri geride bırakıp bir sonrakine henüz varmadığınız o an, aslında seyahatin en saf halidir. Ne geçmiş ne gelecek — sadece hareket.</p><p>Yıllar içinde fark ettim ki en değerli anılarım genellikle "arada" olanlar. Varışlardaki heyecan değil, o sessiz geçiş anları. Bir havalimanı penceresinden izlenen bulutlar, bir istasyonda içilen çay, bir köy otobüsünde geçen beklenmedik bir sohbet.</p><p>Seyahat etmeyi öğrenmek, bu aralara hoş geldin diyebilmektir.</p>',
                'content_en'    => '<p>Between every flight, in the middle of every train journey, during the uncertain hours of every long bus ride, something happens: you think.</p><p>That moment when you\'ve left a crowded city behind and haven\'t yet arrived at the next — that is travel in its purest form. Neither past nor future, only movement.</p><p>Over the years I\'ve noticed that my most valuable memories are usually the "in-between" ones. Not the excitement of arrivals, but those quiet transition moments. Clouds watched through an airport window, tea drunk at a station, an unexpected conversation on a village bus.</p><p>Learning to travel means being able to say welcome to these in-between moments.</p>',
                'is_published'  => true,
                'published_at'  => now()->subDays(12),
            ],
        ];

        foreach ($posts as $post) {
            DB::table('posts')->updateOrInsert(
                ['slug' => $post['slug']],
                array_merge($post, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
