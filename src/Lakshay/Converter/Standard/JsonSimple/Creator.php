<?php
namespace Lakshay\Converter\Standard\JsonSimple;

use Lakshay\Converter\Interfaces\CreatorInterface;
use Lakshay\Converter\Model\Entries;
use Lakshay\Converter\Model\Persons;
use Lakshay\Converter\Model\Dates;

/**
 * TODO: Creator comment.
 *
 * @author  Benjamin Geißler <benjamin.geissler@gmail.com>
 * @license MIT
 */
class Creator implements CreatorInterface
{

    private $enc = null;

    /**
     * Create entries based on the given standard from the \Lakshay\Converter\Model\Entries object.
     *
     * @param \Lakshay\Converter\Model\Entries $data
     * @return boolean
     */
    public function create(Entries $data)
    {
        // TODO: Implement create() method.

        if (count($data) > 0) {
            $this->enc =   array();

            foreach ($data as $entry) {
                /** @var $entry \Lakshay\Converter\Model\Entry */
                $record =   array();

                $record['type'] =   $this->getType($entry->getType()->getType());

                $record['elaboratedtype'] =   $entry->getType()->getType();

                $persons        =   array(
                    'author'                =>  'getAuthor',
                    'collection-editor'     =>  'getCollectionEditor',
                    'container-author'      =>  'getContainerAuthor',
                    'director'              =>  'getDirector',
                    'editor'                =>  'getEditor',
                    'editorial-director'    =>  'getEditorialDirector',
                    'illustrator'           =>  'getIllustrator',
                    'interviewer'           =>  'getInterviewer',
                    'original-author'       =>  'getOriginalAuthor',
                    'recipient'             =>  'getRecipient',
                    'reviewed-author'       =>  'getReviewedAuthor',
                    'translator'            =>  'getTranslator'
                );
                foreach ($persons as $field => $getter) {
                    $person =   $this->createPerson( $entry->$getter() );

                    if (count($person) > 0) {
                        $record[$field] =   $person;
                    }
                }

                $dates  =   array(
                    'accessed'      =>  'getAccessed',
                    'event-date'    =>  'getEventDate',
                    'issued'        =>  'getIssued',
                    'original-date' =>  'getOriginalDate',
                    'submitted'     =>  'getSubmitted'
                );
                foreach ($dates as $field => $getter) {
                    $date   =   $this->createDate( $entry->$getter() );

                    if (count($date) > 0) {
                        $record[$field] =   $date;
                    }
                }

                // pages
                if ($entry->getPages()->getRange() !== null) {
                    $record['page'] =   $entry->getPages()->getRange();
                } elseif ($entry->getPages()->getStart() !== null
                    && $entry->getPages()->getEnd() !== null) {
                    $record['page'] =   $entry->getPages()->getStart() . '-' . $entry->getPages()->getEnd();
                } elseif ($entry->getPages()->getStart() !== null) {
                    $record['page'] =   $entry->getPages()->getStart();
                } elseif ($entry->getPages()->getEnd() !== null) {
                    $record['page'] =   $entry->getPages()->getEnd();
                } elseif ($entry->getPages()->getTotal() !== null) {
                    $record['page'] =   $entry->getPages()->getTotal();
                }

                if ($entry->getPages()->getStart() !== null) {
                    $record['page-first'] =   $entry->getPages()->getStart();
                }

                $fields = array(
                    'abstract'                    => 'getAbstract',
                    'annote'                      => 'getAnnote',
                    'archive'                     => 'getArchive',
                    'archive_location'            => 'getArchiveLocation',
                    'archive-place'               => 'getArchivePlace',
                    'authority'                   => 'getAuthority',
                    'call-number'                 => 'getCallNumber',
                    'citation-label'              => 'getCitationLabel',
                    'collection-title'            => 'getCollectionTitle',
                    'container-title'             => 'getContainerTitle',
                    'container-title-short'       => 'getContainerTitleShort',
                    'dimensions'                  => 'getDimensions',
                    'DOI'                         => 'getDOI',
                    'event'                       => 'getEvent',
                    'event-place'                 => 'getEventPlace',
                    'genre'                       => 'getGenre',
                    'ISBN'                        => 'getISBN',
                    'ISSN'                        => 'getISSN',
                    'jurisdiction'                => 'getJurisdiction',
                    'keyword'                     => 'getKeyword',
                    'medium'                      => 'getMedium',
                    'note'                        => 'getNote',
                    'original-publisher'          => 'getOriginalPublisher',
                    'original-publisher-place'    => 'getOriginalPublisherPlace',
                    'original-title'              => 'getOriginalTitle',
                    'PMCID'                       => 'getPMCID',
                    'PMID'                        => 'getPMID',
                    'publisher'                   => 'getPublisher',
                    'publisher-place'             => 'getPublisherPlace',
                    'references'                  => 'getReferences',
                    'reviewed-title'              => 'getReviewedTitle',
                    'scale'                       => 'getScale',
                    'section'                     => 'getSection',
                    'source'                      => 'getSource',
                    'status'                      => 'getStatus',
                    'title'                       => 'getTitle',
                    'title-short'                 => 'getTitleShort',
                    'URL'                         => 'getURL',
                    'version'                     => 'getVersion',
                    'yearSuffix'                  => 'getYearSuffix'
                );

                foreach ($fields as $field => $getter) {
                    $value  =   $entry->$getter();
                    if ($value != ''
                        && $value !== null
                        && (
                            (is_array($value) == true
                                && count($value) > 0)
                            || is_array($value) == false
                            )
                        ) {
                        $record[$field] =   $value;
                    }
                }

                $bibCreator = new \Lakshay\Converter\Standard\BibTeX\Creator();

                $bib_entries = new Entries();
                $bib_entries->setEntry( $entry );

                $bibCreated = $bibCreator->create( $bib_entries );

                $record['bibtex_raw'] = $bibCreated ? $bibCreator->retrieve() : null;

                $this->enc[]   =   $record;
            }

            return true;
        }

        return false;

    }

    /**
     * Retrieve the created standard data. Return false if standard could not be created.
     *
     * @return string|boolean
     */
    public function retrieve()
    {
        // TODO: Implement retrieve() method.
        if( is_null( $this->enc ) ){
            return false;
        }

        return $this->enc;
    }

    /**
     * Retrieve the entry type.
     *
     * @param string $type
     * @return string
     */
    private function getType($type)
    {
        switch ($type) {
            case 'articleJournal':
                return 'article-journal';
            case 'articleMagazine':
                return 'article-magazine';
            case 'articleNewspaper':
                return 'article-newspaper';
            case 'dictionary':
            case 'encyclopedia':
                return 'entry';
            case 'entryDictionary':
                return 'entry-dictionary';
            case 'entryEncyclopedia':
                return 'entry-encyclopedia';
            case 'legalCase':
                return 'legal_case';
            case 'motionPicture':
                return 'motion_picture';
            case 'musicalScore':
                return 'musical_score';
            case 'paperConference':
                return 'paper-conference';
            case 'postWeblog':
                return 'post-weblog';
            case 'personalCommunication':
                return 'personal_communication';
            case 'reviewBook':
                return 'review-book';
            default:
                return $type;
        }
    }

    /**
     * Convert \Lakshay\Converter\Model\Person objects into csl names.
     *
     * @param \Lakshay\Converter\Model\Persons $persons
     * @return array
     */
    private function createPerson(Persons $persons)
    {
        $data   =   array();
        $mapper =   array(
            'family'                =>  'getFamily',
            'given'                 =>  'getGiven',
            'dropping-particle'     =>  'getDroppingParticle',
            'non-dropping-particle' =>  'getNonDroppingParticle',
            'suffix'                =>  'getSuffix'
        );

        foreach ($persons as $person) {
            $entry  =   array();

            foreach ($mapper as $key => $getter) {
                if ($person->$getter() !== '') {
                    $entry[$key]    =   $person->$getter();
                }
            }

            $data[] =   $entry;
        }

        return $data;
    }

    /**
     * Convert \Lakshay\Converter\Model\Date objects into csl dates.
     *
     * @param \Lakshay\Converter\Model\Dates $dates
     * @return array
     */
    private function createDate(Dates $dates)
    {
        $data   =   array();

        foreach ($dates as $date) {
            /** @var $date \Lakshay\Converter\Model\Date */
            $entry  =   array();
            if ($date->getYear() !== null) {
                $entry['year']  =   $date->getYear();
            }

            if ($date->getMonth() !== null) {
                $entry['month']  =   $date->getMonth();
            }

            if ($date->getDay() !== null) {
                $entry['day']  =   $date->getDay();
            }

            $data[] =   $entry;
        }

        return $data;
    }
}
