<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace Jyotish\Base;

/**
 * Biblio data class.
 *
 * @author Kunjara Lila das <vladya108@gmail.com>
 */
class Biblio
{
    /**
     * Brihat Parashara Hora Shastra
     */
    const BOOK_BPHS = 'bphs';
    /**
     * Upadesha Sutras
     */
    const BOOK_US = 'us';
    /**
     * Brihat Jataka
     */
    const BOOK_BJ = 'bj';
    /**
     * Brihat Samhita
     */
    const BOOK_BS = 'bs';
    /**
     * Saravali
     */
    const BOOK_SA = 'sa';
    /**
     * Satya Jatakam
     */
    const BOOK_SJ = 'sj';
    /**
     * Uttara Kalamritam
     */
    const BOOK_UK = 'uk';
    /**
     * Sarvarth Chintamani
     */
    const BOOK_SC = 'sc';
    /**
     * Phaladeepika
     */
    const BOOK_PH = 'ph';
    /**
     * Jataka Parijata
     */
    const BOOK_JP = 'jp';
    /**
     * Srimad-Bhagavatam
     */
    const BOOK_SB = 'sb';
    /**
     * Bhavishya Purana
     */
    const BOOK_BP = 'bp';
    /**
     * Surya Siddhanta
     */
    const BOOK_SS = 'ss';
    /**
     * Manu-samhita
     */
    const BOOK_MS = 'ms';
    
    /**
     * Parashara
     */
    const AUTHOR_PARASHARA = 'parashara';
    /**
     * Jaimini
     */
    const AUTHOR_JAIMINI = 'jaimini';
    /**
     * Varahamihira
     */
    const AUTHOR_VARAHAMIHIRA = 'varahamihira';
    /**
     * Kalyana Varma
     */
    const AUTHOR_KVARMA = 'kvarma';
    /**
     * Satyacharya
     */
    const AUTHOR_SATYACHARYA = 'satyacharya';
    /**
     * Kalidas
     */
    const AUTHOR_KALIDAS = 'kalidas';
    /**
     * Venkatesh Sharma
     */
    const AUTHOR_VSHARMA = 'vsharma';
    /**
     * Mantreswara
     */
    const AUTHOR_MANTRESWARA = 'mantreswara';
    /**
     * Vaidyanatha Dikshita
     */
    const AUTHOR_VDIKSHITA = 'vdikshita';
    
    /**
     * Common
     */
    const COMMON = 'common';
    
    /**
     * List of literatures.
     * 
     * @var array
     */
    public static $book = [
        self::BOOK_BPHS => 'Brihat Parashara Hora Shastra',
        self::BOOK_US => 'Upadesha Sutras',
        self::BOOK_BJ => 'Brihat Jataka',
        self::BOOK_BS => 'Brihat Samhita',
        self::BOOK_SA => 'Saravali',
        self::BOOK_SJ => 'Satya Jatakam',
        self::BOOK_UK => 'Uttara Kalamritam',
        self::BOOK_SC => 'Sarvarth Chintamani',
        self::BOOK_PH => 'Phaladeepika',
        self::BOOK_JP => 'Jataka Parijata',
        self::BOOK_SB => 'Srimad-Bhagavatam',
        self::BOOK_BP => 'Bhavishya Purana',
        self::BOOK_SS => 'Surya Siddhanta',
        self::BOOK_MS => 'Manu-samhita',
    ];
    
    /**
     * List of authors.
     * 
     * @var array
     */
    public static $author = [
        self::AUTHOR_PARASHARA => [
            'name' => 'Parashara',
            'books' => [self::BOOK_BPHS],
        ],
        self::AUTHOR_JAIMINI => [
            'name' => 'Jaimini',
            'books' => [self::BOOK_US],
        ],
        self::AUTHOR_VARAHAMIHIRA => [
            'name' => 'Varahamihira',
            'books' => [self::BOOK_BJ, self::BOOK_BS],
        ],
        self::AUTHOR_KVARMA => [
            'name' => 'Kalyana Varma',
            'books' => [self::BOOK_SA],
        ],
        self::AUTHOR_SATYACHARYA => [
            'name' => 'Satyacharya',
            'books' => [self::BOOK_SJ],
        ],
        self::AUTHOR_KALIDAS => [
            'name' => 'Kalidas',
            'books' => [self::BOOK_UK],
        ],
        self::AUTHOR_VSHARMA => [
            'name' => 'Venkatesh Sharma',
            'books' => [self::BOOK_SC],
        ],
        self::AUTHOR_MANTRESWARA => [
            'name' => 'Mantreswara',
            'books' => [self::BOOK_PH],
        ],
        self::AUTHOR_VDIKSHITA => [
            'name' => 'Vaidyanatha Dikshita',
            'books' => [self::BOOK_JP],
        ],
    ];
}
