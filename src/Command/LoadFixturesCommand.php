<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:load-fixtures',
    description: 'Charge les données de démonstration (catégories + produits)',
)]
class LoadFixturesCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Chargement des données de démonstration');

        // Vider les tables existantes
        $this->em->getConnection()->executeStatement('DELETE FROM product');
        $this->em->getConnection()->executeStatement('DELETE FROM category');

        $categoriesData = [
            ['name' => 'Électronique',     'icon' => '💻', 'badge' => 'primary',   'desc' => 'Casques, enceintes, gadgets et bien plus encore.'],
            ['name' => 'Mode',             'icon' => '👗', 'badge' => 'warning',   'desc' => 'Vêtements, accessoires et chaussures tendance.'],
            ['name' => 'Maison & Jardin',  'icon' => '🌿', 'badge' => 'success',   'desc' => 'Mobilier, décoration et outils de jardinage.'],
            ['name' => 'Sports & Fitness', 'icon' => '🏋️', 'badge' => 'info',      'desc' => 'Équipements sportifs, tapis de yoga et matériel de fitness.'],
            ['name' => 'Livres',           'icon' => '📚', 'badge' => 'danger',    'desc' => 'Fiction, non-fiction et ouvrages éducatifs.'],
            ['name' => 'Beauté & Santé',   'icon' => '💄', 'badge' => 'secondary', 'desc' => 'Soins de la peau, cosmétiques et bien-être.'],
            ['name' => 'Jouets & Jeux',    'icon' => '🎮', 'badge' => 'primary',   'desc' => 'Amusement pour enfants et divertissement familial.'],
            ['name' => 'Automobile',       'icon' => '🚗', 'badge' => 'dark',      'desc' => 'Accessoires auto et outils d\'entretien.'],
            ['name' => 'Animaux',          'icon' => '🐾', 'badge' => 'warning',   'desc' => 'Nourriture, jouets et accessoires pour animaux.'],
        ];

        $productsData = [
            'Électronique' => [
                ['name' => 'Casque Bluetooth Pro',    'price' => 79.99,  'stock' => 15, 'sku' => 'ELEC-001', 'desc' => 'Casque sans fil à réduction de bruit active, 30h d\'autonomie, son stéréo premium.'],
                ['name' => 'Enceinte Bluetooth',      'price' => 59.99,  'stock' => 20, 'sku' => 'ELEC-002', 'desc' => 'Enceinte portable imperméable IPX7, son puissant à 360°, autonomie 24h.'],
                ['name' => 'Support Smartphone',      'price' => 19.99,  'stock' => 40, 'sku' => 'ELEC-003', 'desc' => 'Support universel réglable pour bureau et voiture.'],
                ['name' => 'Câble USB-C 2m',          'price' => 12.99,  'stock' => 80, 'sku' => 'ELEC-004', 'desc' => 'Câble charge rapide 100W, résistant, compatible tous appareils USB-C.'],
                ['name' => 'Souris sans fil',         'price' => 29.99,  'stock' => 30, 'sku' => 'ELEC-005', 'desc' => 'Souris ergonomique silencieuse, 1600 DPI, autonomie 12 mois.'],
                ['name' => 'Clavier mécanique',       'price' => 89.99,  'stock' => 10, 'sku' => 'ELEC-006', 'desc' => 'Clavier gaming rétroéclairé RGB, switches bleus, anti-ghosting.'],
                ['name' => 'Webcam HD 1080p',         'price' => 49.99,  'stock' => 12, 'sku' => 'ELEC-007', 'desc' => 'Webcam Full HD avec micro intégré, compatible Zoom et Teams.'],
                ['name' => 'Powerbank 20000mAh',      'price' => 39.99,  'stock' => 25, 'sku' => 'ELEC-008', 'desc' => 'Batterie externe grande capacité, charge rapide 22.5W, 3 ports.'],
                ['name' => 'Montre connectée',        'price' => 199.99, 'stock' => 8,  'sku' => 'ELEC-009', 'desc' => 'Smartwatch GPS, suivi santé, 100+ sports, autonomie 14 jours.'],
                ['name' => 'Hub USB-C 7-en-1',        'price' => 45.99,  'stock' => 18, 'sku' => 'ELEC-010', 'desc' => 'Hub multiport HDMI 4K, USB 3.0, SD, charge 100W passthrough.'],
            ],
            'Mode' => [
                ['name' => 'T-shirt Premium Coton',   'price' => 24.99, 'stock' => 50, 'sku' => 'MODE-001', 'desc' => 'T-shirt 100% coton biologique, coupe moderne, nombreux coloris.'],
                ['name' => 'Jean Slim Stretch',       'price' => 59.99, 'stock' => 30, 'sku' => 'MODE-002', 'desc' => 'Jean slim confortable avec stretch, disponible en plusieurs tailles.'],
                ['name' => 'Sneakers Urban',          'price' => 89.99, 'stock' => 20, 'sku' => 'MODE-003', 'desc' => 'Baskets légères et respirantes, semelle amortissante, style contemporain.'],
                ['name' => 'Veste en lin',            'price' => 79.99, 'stock' => 15, 'sku' => 'MODE-004', 'desc' => 'Veste légère en lin naturel, parfaite pour l\'été, coupe droite.'],
                ['name' => 'Sac à main en cuir',     'price' => 129.99, 'stock' => 10, 'sku' => 'MODE-005', 'desc' => 'Sac à main en cuir véritable, compartiments multiples, bandoulière réglable.'],
            ],
            'Maison & Jardin' => [
                ['name' => 'Lampe de bureau LED',     'price' => 34.99, 'stock' => 22, 'sku' => 'MAIS-001', 'desc' => 'Lampe LED réglable 5 niveaux, port USB intégré, lumière chaude/froide.'],
                ['name' => 'Plante artificielle',     'price' => 19.99, 'stock' => 35, 'sku' => 'MAIS-002', 'desc' => 'Plante décorative réaliste, sans entretien, idéale pour bureau ou salon.'],
                ['name' => 'Arrosoir Design',         'price' => 22.99, 'stock' => 18, 'sku' => 'MAIS-003', 'desc' => 'Arrosoir en acier inoxydable bec long, capacité 1.5L, design élégant.'],
                ['name' => 'Coussin décoratif',       'price' => 15.99, 'stock' => 45, 'sku' => 'MAIS-004', 'desc' => 'Coussin en velours 45x45cm, housse lavable, nombreux motifs disponibles.'],
                ['name' => 'Bougie parfumée',         'price' => 12.99, 'stock' => 60, 'sku' => 'MAIS-005', 'desc' => 'Bougie en cire de soja, parfum vanille-bois, durée 50h, pot en verre.'],
            ],
            'Sports & Fitness' => [
                ['name' => 'Tapis de yoga',           'price' => 29.99, 'stock' => 25, 'sku' => 'SPRT-001', 'desc' => 'Tapis yoga antidérapant 6mm, matière écologique, sangle de transport incluse.'],
                ['name' => 'Haltères ajustables',     'price' => 79.99, 'stock' => 12, 'sku' => 'SPRT-002', 'desc' => 'Paire d\'haltères 2-24kg réglables, remplacement de 15 haltères.'],
                ['name' => 'Corde à sauter Pro',      'price' => 14.99, 'stock' => 40, 'sku' => 'SPRT-003', 'desc' => 'Corde à sauter avec roulements à billes, longueur réglable, poignées ergonomiques.'],
                ['name' => 'Bouteille sport 1L',      'price' => 18.99, 'stock' => 50, 'sku' => 'SPRT-004', 'desc' => 'Gourde isotherme inox, garde au frais 24h, sans BPA, bouchon étanche.'],
            ],
            'Livres' => [
                ['name' => 'Clean Code',              'price' => 34.99, 'stock' => 15, 'sku' => 'LIVR-001', 'desc' => 'Le guide de référence pour écrire un code propre et maintenable par Robert C. Martin.'],
                ['name' => 'Le Petit Prince',         'price' => 8.99,  'stock' => 30, 'sku' => 'LIVR-002', 'desc' => 'Chef-d\'œuvre intemporel d\'Antoine de Saint-Exupéry, édition illustrée.'],
                ['name' => 'Atomic Habits',           'price' => 19.99, 'stock' => 20, 'sku' => 'LIVR-003', 'desc' => 'Comment construire de bonnes habitudes et se débarrasser des mauvaises par James Clear.'],
                ['name' => 'Sapiens',                 'price' => 22.99, 'stock' => 18, 'sku' => 'LIVR-004', 'desc' => 'Une brève histoire de l\'humanité par Yuval Noah Harari.'],
            ],
            'Beauté & Santé' => [
                ['name' => 'Sérum Vitamine C',        'price' => 28.99, 'stock' => 25, 'sku' => 'BEAU-001', 'desc' => 'Sérum anti-âge à la Vitamine C 20%, éclat et uniformisation du teint.'],
                ['name' => 'Crème hydratante SPF50',  'price' => 22.99, 'stock' => 30, 'sku' => 'BEAU-002', 'desc' => 'Crème de jour légère protection solaire SPF50, texture non grasse, parfum neutre.'],
                ['name' => 'Brosse à dents électrique','price' => 49.99,'stock' => 18, 'sku' => 'BEAU-003', 'desc' => 'Brosse électrique sonique 3 modes, 2min timer, charge USB, 4 têtes incluses.'],
                ['name' => 'Huile essentielle Lavande','price' => 12.99,'stock' => 40, 'sku' => 'BEAU-004', 'desc' => 'Huile essentielle de lavande pure 100% naturelle, relaxation et sommeil, 10ml.'],
            ],
            'Jouets & Jeux' => [
                ['name' => 'LEGO Architecture',       'price' => 49.99, 'stock' => 15, 'sku' => 'JEUX-001', 'desc' => 'Ensemble LEGO Architecture 750 pièces, construction et créativité dès 12 ans.'],
                ['name' => 'Puzzle 1000 pièces',      'price' => 18.99, 'stock' => 25, 'sku' => 'JEUX-002', 'desc' => 'Puzzle paysage montagnard 1000 pièces, qualité premium, format 68x48cm.'],
                ['name' => 'Jeu de société Catan',    'price' => 39.99, 'stock' => 12, 'sku' => 'JEUX-003', 'desc' => 'Le jeu de stratégie et de commerce incontournable, 3-4 joueurs, 75min.'],
                ['name' => 'Drone Débutant',          'price' => 69.99, 'stock' => 8,  'sku' => 'JEUX-004', 'desc' => 'Drone quadricoptère stabilisé, télécommande intuitive, autonomie 15min.'],
            ],
            'Automobile' => [
                ['name' => 'Support téléphone voiture','price' => 16.99,'stock' => 40, 'sku' => 'AUTO-001', 'desc' => 'Support magnétique grille d\'aération, rotation 360°, compatible tous smartphones.'],
                ['name' => 'Chargeur voiture USB-C',  'price' => 19.99, 'stock' => 35, 'sku' => 'AUTO-002', 'desc' => 'Chargeur allume-cigare double port 45W, charge rapide PD, compact.'],
                ['name' => 'Aspirateur voiture 12V',  'price' => 34.99, 'stock' => 15, 'sku' => 'AUTO-003', 'desc' => 'Mini aspirateur portable 12V sur allume-cigare, 5000Pa, filtre HEPA.'],
            ],
            'Animaux' => [
                ['name' => 'Gamelle automatique',     'price' => 39.99, 'stock' => 18, 'sku' => 'ANIM-001', 'desc' => 'Distributeur de croquettes programmable 4 repas/jour, écran LCD, 4L.'],
                ['name' => 'Jouet chat interactif',   'price' => 14.99, 'stock' => 30, 'sku' => 'ANIM-002', 'desc' => 'Jouet automatique laser pour chat, 3 vitesses, arrêt automatique 15min.'],
                ['name' => 'Laisse rétractable 5m',   'price' => 22.99, 'stock' => 25, 'sku' => 'ANIM-003', 'desc' => 'Laisse extensible jusqu\'à 5m, système de freinage instantané, jusqu\'à 25kg.'],
                ['name' => 'Lit moelleux pour chien', 'price' => 44.99, 'stock' => 12, 'sku' => 'ANIM-004', 'desc' => 'Panier orthopédique pour chien, mousse mémoire de forme, housse lavable.'],
            ],
        ];

        $io->section('Création des catégories et produits...');

        $categoryEntities = [];
        foreach ($categoriesData as $catData) {
            $category = new Category();
            $category->setName($catData['name']);
            $category->setDescription($catData['desc']);
            $category->setIcon($catData['icon']);
            $category->setBadgeColor($catData['badge']);
            $this->em->persist($category);
            $categoryEntities[$catData['name']] = $category;
            $io->text('  ✅ Catégorie : ' . $catData['icon'] . ' ' . $catData['name']);
        }

        $this->em->flush();

        $totalProducts = 0;
        foreach ($productsData as $catName => $products) {
            $category = $categoryEntities[$catName] ?? null;
            if (!$category) {
                continue;
            }
            foreach ($products as $pData) {
                $product = new Product();
                $product->setName($pData['name']);
                $product->setDescription($pData['desc']);
                $product->setPrice($pData['price']);
                $product->setStock($pData['stock']);
                $product->setSku($pData['sku']);
                $product->setCategory($category);
                $this->em->persist($product);
                $totalProducts++;
            }
        }

        $this->em->flush();

        $io->success(sprintf(
            'Données chargées : %d catégories, %d produits.',
            count($categoriesData),
            $totalProducts
        ));

        return Command::SUCCESS;
    }
}
