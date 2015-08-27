<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Tattva\Jiva\Nara;

/**
 * Class of Deva gana.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Deva extends \Jyotish\Tattva\Jiva\Nara {
    const DEVA_ADITI = 'Aditi';
    const DEVA_AGNI = 'Agni';
    const DEVA_AHIRBUDHYANA = 'Ahirbudhyana';
    const DEVA_AJIKAPADA = 'Ajikapada';
    const DEVA_APAH = 'Apah';
    const DEVA_ARYAMA = 'Aryama';
    const DEVA_ASHWINI = 'Ashwini';
    const DEVA_BHAGA = 'Bhaga';
    const DEVA_BRAHMA = 'Brahma';
    const DEVA_BRAHMA_PRAJAPATI = 'Prajapati';
    const DEVA_BUDHA = 'Budha';
    const DEVA_BUDHA_KUMAR = 'Kumar';
    const DEVA_GURU = 'Guru';
    const DEVA_GURU_BRIHASPATI = 'Brihaspati';
    const DEVA_CHANDRA = 'Chandra';
    const DEVA_CHANDRA_SOMA = 'Soma';
    const DEVA_GANAPATHI = 'Ganapathi';
    const DEVA_HIRANYAGARBHA = 'Hiranyagarbha';
    const DEVA_INDRA = 'Indra';
    const DEVA_KAMADEV = 'Kamadev';
    const DEVA_KAMADEV_MANMATHA = 'Manmatha';
    const DEVA_KARTTIKEYA = 'Karttikeya';
    const DEVA_KARTTIKEYA_MURUGAN = 'Murugan';
    const DEVA_KARTTIKEYA_SENAPATI = 'Senapati';
    const DEVA_KARTTIKEYA_SKANDA = 'Skanda';
    const DEVA_KARTTIKEYA_SUBRAMANYA = 'Subramanya';
    const DEVA_KUBER = 'Kuber';
    const DEVA_MANGAL = 'Mangal';
    const DEVA_MANGAL_KUJA = 'Kuja';
    const DEVA_MARUTH = 'Maruth';
    const DEVA_NIRRITI = 'Nirriti';
    const DEVA_PARVATI = 'Parvati';
    const DEVA_PARVATI_GAURI = 'Gauri';
    const DEVA_PARVATI_DUGRA = 'Durga';
    const DEVA_PARVATI_KALI = 'Kali';
    const DEVA_PAVAMANA = 'Pavamana';
    const DEVA_PUSHA = 'Pusha';
    const DEVA_PITRU = 'Pitru';
    const DEVA_PRITHVI = 'Prithvi';
    const DEVA_SARPA = 'Sarpa';
    const DEVA_RATRI = 'Ratri';
    const DEVA_SHACHI = 'Shachi';
    const DEVA_SHANI = 'Shani';
    const DEVA_SHANI_SHANAISHCHARA = 'Shanaishchara';
    const DEVA_SHIVA = 'Shiva';
    const DEVA_SHIVA_RUDRA = 'Rudra';
    const DEVA_SHUKRA = 'Shukra';
    const DEVA_SHUKRA_USHANAS = 'Ushanas';
    const DEVA_SURYA = 'Surya';
    const DEVA_SURYA_MITRA = 'Mitra';
    const DEVA_SURYA_RAVI = 'Ravi';
    const DEVA_SURYA_SAVITRI = 'Savitri';
    const DEVA_SURYA_VIVASVAN = 'Vivasvan';
    const DEVA_TWASHTR = 'Twashtr';
    const DEVA_VARUNA = 'Varuna';
    const DEVA_VARUNA_AMBU = 'Ambu';
    const DEVA_VASU = 'Vasu';
    const DEVA_VAYU = 'Vayu';
    const DEVA_VIDHATA = 'Vidhata';
    const DEVA_VISHNU = 'Vishnu';
    const DEVA_VISHNU_ISHVARA = 'Ishvara';
    const DEVA_VISHNU_HARI = 'Hari';
    const DEVA_VISHNU_KESHAVA = 'Keshava';
    const DEVA_VISHNU_MAHA = 'Maha Vishnu';
    const DEVA_VISHNU_YAJNESHVARA = 'Yajneshvara';
    const DEVA_VISHVADEVA = 'Vishvadeva';
    const DEVA_YAMA = 'Yama';
    const DEVA_YAMA_DHARMA = 'Dharmaraja';
    
    public static $triMurti = [
        self::DEVA_BRAHMA,
        self::DEVA_VISHNU,
        self::DEVA_SHIVA
    ];

    public static $nameVishnu = [
        self::DEVA_VISHNU,
        self::DEVA_VISHNU_ISHVARA,
        self::DEVA_VISHNU_HARI,
        self::DEVA_VISHNU_KESHAVA,
        self::DEVA_VISHNU_MAHA,
        self::DEVA_VISHNU_YAJNESHVARA,
    ];

    public static $nameShiva = [
        self::DEVA_SHIVA,
        self::DEVA_SHIVA_RUDRA,
    ];	

    public static $nameBrahma = [
        self::DEVA_BRAHMA,
        self::DEVA_BRAHMA_PRAJAPATI,
    ];

    public static $nameSurya = [
        self::DEVA_SURYA,
        self::DEVA_SURYA_MITRA,
        self::DEVA_SURYA_RAVI,
        self::DEVA_SURYA_SAVITRI,
        self::DEVA_SURYA_VIVASVAN,
    ];

    public static $nameChandra = [
        self::DEVA_CHANDRA,
        self::DEVA_CHANDRA_SOMA,
    ];

    public static $nameGuru = [
        self::DEVA_GURU,
        self::DEVA_GURU_BRIHASPATI,
    ];

    public static $nameMangal = [
        self::DEVA_MANGAL,
        self::DEVA_MANGAL_KUJA,
    ];

    public static $nameBudha = [
        self::DEVA_BUDHA,
        self::DEVA_BUDHA_KUMAR,
    ];

    public static $nameShukra = [
        self::DEVA_SHUKRA,
        self::DEVA_SHUKRA_USHANAS,
    ];

    public static $nameShani = [
        self::DEVA_SHANI,
        self::DEVA_SHANI_SHANAISHCHARA,
    ];

    public static $nameKarttikeya = [
        self::DEVA_KARTTIKEYA,
        self::DEVA_KARTTIKEYA_MURUGAN,
        self::DEVA_KARTTIKEYA_SENAPATI,
        self::DEVA_KARTTIKEYA_SKANDA,
        self::DEVA_KARTTIKEYA_SUBRAMANYA,
    ];

    public static $nameParvati = [
        self::DEVA_PARVATI,
        self::DEVA_PARVATI_DUGRA,
        self::DEVA_PARVATI_GAURI,
        self::DEVA_PARVATI_KALI,
    ];

    public static $nameYama = [
        self::DEVA_YAMA,
        self::DEVA_YAMA_DHARMA,
    ];
}
