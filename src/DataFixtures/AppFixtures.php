<?php

namespace App\DataFixtures;

use App\Entity\Word;
use App\Entity\WordsList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // english list
        $englishWords = array(
            array('cat', 'chat', 'Se prononce « Kat »'),
            array('dog', 'chien', ''),
            array('to get', 'avoir', 'Dans le sens « obtenir », « posséder », déclinaisons : get, got, got'),
            array('to have', 'avoir', 'Déclinaisons : Have, Had, Had'),
            array('hello', 'bonjour', ''),
            array('good evening', 'bonsoir', ''),
            array('cow', 'vache', ''),
            array('beach', 'plage', 'Se prononce "beet-ch"'),
            array('pillow', 'coussin', ''),
            array('he', 'il', ''),
            array('she', 'elle', ''),
            array('software', 'logiciel', ''),
            array('hardware', 'matériel informatique', ''),
            array('soft drink', 'boisson sans alcool', 'De l\'anglais soft, doux, et drink, boisson'),
            array('to be', 'être', 'Be, was/were, been'),
            array('to come', 'venir', 'Come, came, come'),
            array('to swim', 'nager', 'Swim, swam, swum'),
            array('but', 'mais', 'Se prononce "Beut"'),
            array('bread', 'pain', ''),
            array('book', 'livre', ''),
            array('drapeau', 'flag', ''),
       );


        $englishWordsList = new WordsList();
        $englishWordsList->setName('Anglais');
        $englishWordsList->setNoteBookColor('redNotebook');
        $englishWordsList->setUser($this->getReference("user-pierre"));

        for($i = 0 ; $i < count($englishWords) ; $i++)
        {
            $englishWord = new Word();
            $englishWord->setFromWord($englishWords[$i][0]);
            $englishWord->setToTranslation($englishWords[$i][1]);
            $englishWord->setDescription($englishWords[$i][2]);
            $englishWord->setWordsList($englishWordsList);
            $manager->persist($englishWord);
        }

        $manager->persist($englishWordsList);

        //chinese list
        $chineseWords = array(
            array('你好', 'bonjour', 'Nǐ hǎo'),
            array('房子', 'maison', 'Fángzi'),
            array('计算机', 'ordinateur', 'Jìsuànjī'),
        );

        $chineseWordsList = new WordsList();
        $chineseWordsList->setName('Chinois');
        $chineseWordsList->setNoteBookColor('blueNotebook');
        $chineseWordsList->setUser($this->getReference("user-pierre"));

        for($i = 0 ; $i < count($chineseWords) ; $i++)
        {
            $chineseWord = new Word();
            $chineseWord->setFromWord($chineseWords[$i][0]);
            $chineseWord->setToTranslation($chineseWords[$i][1]);
            $chineseWord->setDescription($chineseWords[$i][2]);
            $chineseWord->setWordsList($chineseWordsList);
            $manager->persist($chineseWord);
        }

        $manager->persist($chineseWordsList);

        // italian list
        $italianWords = array(
            array('buongiorno', 'bonjour', ''),
            array('signore', 'monsieur', ''),
            array('acqua', 'eau', 'Au pluriel "Acque"'),
            array('Roma', 'roma', ''),
            array('mangiare', 'manger', 'Je mange "Sto mangiando"'),
            array('possibile', 'possible', 'Au pluriel possibile également'),
            array('barca', 'bâteau', ''),
            array('per favore', 'S\'il te plaît', ''),
            array('per piecere', 'S\'il vous plaît', ''),
            array('matita', 'crayon', ''),
            array('quadro', 'tableau', ''),
            array('mettere', 'mettre', 'Je mets "Ho messo"'),
            array('prendere', 'prendre', 'Je prends "Prendo"'),
            array('fare', 'faire', 'Je fais Lo sto facendo"'),
            array('animale', 'animal', ''),
        );

        $italianWordsList = new WordsList();
        $italianWordsList->setName('Italien');
        $italianWordsList->setNoteBookColor('redNotebook');
        $italianWordsList->setUser($this->getReference("user-pierre"));

        for($i = 0 ; $i < count($italianWords) ; $i++)
        {
            $italianWord = new Word();
            $italianWord->setFromWord($italianWords[$i][0]);
            $italianWord->setToTranslation($italianWords[$i][1]);
            $italianWord->setDescription($italianWords[$i][2]);
            $italianWord->setWordsList($italianWordsList);
            $manager->persist($italianWord);
        }

        $manager->persist($italianWordsList);

        // spanish list
        $spanishWords = array(
            array('pueblo', 'village', ''),
            array('ciudad', 'ville', ''),
            array('carretera', 'route', ''),
            array('jóvenes', 'jeunes', ''),
            array('guapo', 'beau', ''),
            array('coche', 'voiture', ''),
            array('père', 'padre', ''),
            array('mère', 'madre', ''),
            array('enfants', 'chicos', ''),
        );

        $spanishWordsList = new WordsList();
        $spanishWordsList->setName('Espagnol');
        $spanishWordsList->setNoteBookColor('yellowNotebook');
        $spanishWordsList->setUser($this->getReference("user-pierre"));

        for($i = 0 ; $i < count($spanishWords) ; $i++)
        {
            $spanishWord = new Word();
            $spanishWord->setFromWord($spanishWords[$i][0]);
            $spanishWord->setToTranslation($spanishWords[$i][1]);
            $spanishWord->setDescription($spanishWords[$i][2]);
            $spanishWord->setWordsList($spanishWordsList);
            $manager->persist($spanishWord);
        }

        $manager->persist($spanishWordsList);

        // german list
        $germanWords = array(
            array('häufig', 'fréquent', ''),
            array('Abschluss', 'conclusion', ''),
            array('Macht', 'puissance', ''),
            array('Mensch', 'humain', ''),
            array('Westen', 'ouest', ''),
            array('Geschwindigkeit', 'vitesse', ''),
            array('Haus', 'maison', ''),
            array('Blume', 'fleur', ''),
            array('gierig', 'gourmand', ''),
            array('Karneval', 'carnaval', ''),
            array('Vogel', 'oiseau', ''),
            array('Urlaub', 'vacances', ''),
        );

        $germanWordsList = new WordsList();
        $germanWordsList->setName('Allemand');
        $germanWordsList->setNoteBookColor('blueNotebook');
        $germanWordsList->setUser($this->getReference("user-pierre"));

        for($i = 0 ; $i < count($germanWords) ; $i++)
        {
            $germanWord = new Word();
            $germanWord->setFromWord($germanWords[$i][0]);
            $germanWord->setToTranslation($germanWords[$i][1]);
            $germanWord->setDescription($germanWords[$i][2]);
            $germanWord->setWordsList($germanWordsList);
            $manager->persist($germanWord);
        }

        $manager->persist($germanWordsList);

        // portuguese list
        $portugueseWords = array(
            array('presente de aniversário', 'cadeau d’anniversairet', ''),
            array('obrigado', 'merci', ''),
            array('computador', 'ordinateur', ''),
            array('nevoeiro', 'brouillard', ''),
            array('gafanhoto', 'sauterelle', ''),
            array('em seguida', 'ensuite', ''),
            array('-de-rosa', 'rose', ''),
            array('trevo', 'trèfle', ''),
            array('igreja', 'église', ''),
            array('novo', 'nouveau', ''),
            array('droga', 'médicament', ''),
            array('luxo', 'luxe', ''),
            array('bicicleta', 'bicyclette', ''),
        );


        $portugueseWordsList = new WordsList();
        $portugueseWordsList->setName('Portugais');
        $portugueseWordsList->setNoteBookColor('redNotebook');
        $portugueseWordsList->setUser($this->getReference("user-pierre"));

        for($i = 0 ; $i < count($portugueseWords) ; $i++)
        {
            $portugueseWord = new Word();
            $portugueseWord->setFromWord($portugueseWords[$i][0]);
            $portugueseWord->setToTranslation($portugueseWords[$i][1]);
            $portugueseWord->setDescription($portugueseWords[$i][2]);
            $portugueseWord->setWordsList($portugueseWordsList);
            $manager->persist($portugueseWord);
        }

        $manager->persist($portugueseWordsList);

        // russian list
        $russianWords = array(
            array('привет', 'bonjour', 'se prononce Priviet'),
            array('спасибо', 'merci', 'se prononce Spasibo'),
           array('друзья', 'les amis', 'se prononce druz\'ya'),
           array('туристы', 'toursites', 'se prononce turisty'),
           array('праздник', 'vacances', 'se prononce prazdnik'),
           array('метро', 'métro', 'se prononce metro'),
           array('мужчины', 'hommes', 'se prononce muzhchiny'),
           array('женщины', 'femmes', 'se prononce zhenshchiny'),
           array('ресторан', 'restaurant', 'se prononce restoran'),
       );


        $russianWordsList = new WordsList();
        $russianWordsList->setName('Russe');
        $russianWordsList->setNoteBookColor('yellowNotebook');
        $russianWordsList->setUser($this->getReference("user-pierre"));

        for($i = 0 ; $i < count($russianWords) ; $i++)
        {
            $russianWord = new Word();
            $russianWord->setFromWord($russianWords[$i][0]);
            $russianWord->setToTranslation($russianWords[$i][1]);
            $russianWord->setDescription($russianWords[$i][2]);
            $russianWord->setWordsList($russianWordsList);
            $manager->persist($russianWord);
        }

        $manager->persist($russianWordsList);

        // tahitian list
        $tahitianWords = array(
            array('ia ora na', 'bonjour', ''),
            array('mauruuru', 'merci', ''),
            array('moana', 'océan', ''),
            array('tupapau', 'fantôme', ''),
            array('tane', 'homme', ''),
            array('poti\'i', 'danseuse', ''),
            array('purotu', 'belle femme', ''),
            array('vahine', 'femme', ''),
            array('va\'a', 'pirogue', ''),
            array('pahua', 'bénitier', ''),
            array('nehenehe', 'beau', ''),
            array('manu', 'oiseau', ''),
            array('here', 'amour', ''),
            array('iti', 'petit', ''),
            array('nui', 'grand', ''),
        );

        $tahitianWordsList = new WordsList();
        $tahitianWordsList->setName('Tahitien');
        $tahitianWordsList->setNoteBookColor('yellowNotebook');
        $tahitianWordsList->setUser($this->getReference("user-pierre"));

        for($i = 0 ; $i < count($tahitianWords) ; $i++)
        {
            $tahitianWord = new Word();
            $tahitianWord->setFromWord($tahitianWords[$i][0]);
            $tahitianWord->setToTranslation($tahitianWords[$i][1]);
            $tahitianWord->setDescription($tahitianWords[$i][2]);
            $tahitianWord->setWordsList($tahitianWordsList);
            $manager->persist($tahitianWord);
        }

        $manager->persist($tahitianWordsList);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            UserFixture::class
        ];
    }
}
