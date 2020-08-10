<?php

namespace Lakshay\Converter\Standard\EndNote;

use Lakshay\Converter\Interfaces\CreatorInterface;
use Lakshay\Converter\Model\Entries;
use Lakshay\Converter\Model\Persons;
use Lakshay\Converter\Model\Date;
use Lakshay\Converter\Model\Person;


/**
 * TODO: Creator comment.
 *
 * @author  Benjamin Geißler <benjamin.geissler@gmail.com>
 * @license MIT
 */
class Creator implements CreatorInterface
{

    /** @var array */
    private $data;

    /**
     * Create entries based on the given standard from the \Lakshay\Converter\Model\Entries object.
     *
     * @param \Lakshay\Converter\Model\Entries $data
     * @return boolean
     */
    /**
     * Create entries based on the given standard from the \Lakshay\Converter\Model\Entries object.
     *
     * @param \Lakshay\Converter\Model\Entries $data
     * @return boolean
     */
    public function create(Entries $data)
    {
        if (count($data) > 0) {
            $this->data =   array();

            $authors    =   array(
                //'A1'    =>  'getAuthor',
                '%E'    =>  'getEditor',
                '%Y'    =>  'getTranslator',
                '%A'    =>  'getAuthor',
                '%H'    =>  'getOriginalAuthor'
            );


            $fields = array(
                '%Z'    => 'getAbstract',
                '%X'    => 'getAbstract',
                '%J1'    => 'getCollectionTitle',
                '%J2'    => 'getContainerTitle',
                '%J3'    => 'getContainerTitleShort',
                '%@'    => 'getISBN',
                '%Z'    => 'getNote',
                '%I'    => 'getPublisher',
                '%C'    => 'getPublisherPlace',
                '%T'    => 'getTitle',
                '%!'    => 'getOriginalTitle',
                '%B'    => 'getTitleSecondary',
                '%U'    => 'getURL',
                '%V'    => 'getVolume',
                '%N'    => 'getIssue',
                '%R'    => 'getDOI',
                '%7'    => 'getEdition',
                '%G'    => 'getLanguage',
                '%6'    => 'getNumberOfVolumes',
                '%*'    => 'getReviewedTitle',
                '%!'    => 'getTitleShort',
                '%K'    => 'getKeyword'
            );

            $shorten  =   array(
                '%J' =>  array('%J1', '%J2', '%J3')
            );

            foreach ($data as $entry) {
                /** @var $entry \Lakshay\Converter\Model\Entry */
                $record =   array();

                // type
                $record['%0']   =   array($this->getType($entry->getType()->getType()));

                // authors
                foreach ($authors as $field => $method) {
                    if (count($entry->$method()) > 0) {
                        $record[$field] =   array();
                        foreach ($entry->$method() as $person) {
                            /** @var $person \Lakshay\Converter\Model\Person */
                            $record[$field][]   =   $this->getPerson($person);
                        }
                    }
                }

                // dates
                foreach ($entry->getIssued() as $date) {
                    /** @var $date \Lakshay\Converter\Model\Date */
                    if ($date->getYear() != '') {
                        $record['%D'][] = $date->getYear();
                    }

                    $value  =   $this->getDate($date);
                    if ($value !== null) {
                        $record['%8'][] = array($this->getDate($date));
                    }
                }

                // pages
                if ($entry->getPages()->getRange() !== null) {
                    $record['%P']   =   array($entry->getPages()->getRange());
                } elseif (
                    $entry->getPages()->getStart() !== null
                    && $entry->getPages()->getEnd() !== null
                ) {
                    $record['%P']   =   array($entry->getPages()->getStart());
                    $record['%P']   =   array($entry->getPages()->getEnd());
                } elseif ($entry->getPages()->getStart() !== null) {
                    $record['%P']   =   array($entry->getPages()->getStart());
                } elseif ($entry->getPages()->getEnd() !== null) {
                    $record['%P']   =   array($entry->getPages()->getEnd());
                } elseif ($entry->getPages()->getTotal() !== null) {
                    $record['SP']   =   array($entry->getPages()->getTotal());
                }

                // field
                foreach ($fields as $field => $getter) {
                    $value  =   $entry->$getter();
                    if ($value !== null) {
                        if (is_array($value) == true) {
                            $record[$field] =   $value;
                        } else {
                            $record[$field] =   array($value);
                        }
                    }
                }
                foreach ($shorten as $replaceField => $fields) {
                    foreach ($fields as $field) {
                        if (isset($record[$field])) {
                            $record[$replaceField][] = $record[$field][0];
                            unset($record[$field]);
                        }
                    }
                }


                $this->data[]   =   $record;
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
        if (
            isset($this->data) == true
            && count($this->data) > 0
        ) {
            $writer =   new EndNoteWriter();

            return $writer->writeRecords($this->data);
        }

        return false;
    }

    /**
     * Retrieve the type of literature.
     *
     * @param string $type
     * @return string
     */
    private function getType($type)
    {
        switch ($type) {
            case 'abstract':
                return 'Abstract';
            case 'motionPicture':
                return 'Film or Broadcast';
            case 'graphic':
                return 'Artwork';
            case 'bill':
                return 'Bill';
            case 'book':
                return 'Book';
            case 'legalCase':
                return 'Case';
            case 'chapter':
                return 'Book Section';
            case 'articleJournal':
                return 'Journal Article';
            case 'catalog':
                return 'Catalog';
            case 'dataset':
                return 'Online Database';
            case 'webpage':
                return 'Web Page';
            case 'articleMagazine':
                return 'Magazine Article';
            case 'musicalScore':
                return 'Music';
            case 'articleNewspaper':
                return 'Newspaper Article';
            case 'pamphlet':
                return 'Pamphlet';
            case 'personalCommunication':
                return 'Personal Communication';
            case 'report':
                return 'Report';
            case 'thesis':
                return 'Thesis';
            case 'manuscript':
                return 'Unpublished Work';
            case 'patent':
                return 'Patent';
            case 'video':
                return 'Audiovisual Material';
            case 'software':
                return 'Computer Program';
            case 'map':
                return 'Map';
            case 'slide':
                return 'Chart or Table';
            default:
                return 'Book';
        }
    }

    /**
     * Transfer a \Lakshay\Converter\Model\Date object into a date string.
     *
     * @param \Lakshay\Converter\Model\Date $date
     * @return string|null
     */
    private function getDate(Date $date)
    {
        if ($date->getYear() == null) {
            return null;
        }

        $return =   $date->getYear();

        if (
            $date->getDay() !== null
            && $date->getMonth() !== null
        ) {
            $return .=  '/' . $date->getMonth() . '/' . $date->getDay();
        } elseif ($date->getMonth() !== null) {
            $return .=  '/' . $date->getMonth();
        }

        if ($date->getSeason() !== null) {
            $return .= '/';

            if ($date->getMonth() === null) {
                $return .= '/';
            }

            if ($date->getDay() == null) {
                $return .= '/';
            }

            return $return . $date->getSeason();
        }

        return $return;
    }

    /**
     * Transfer a \Lakshay\Converter\Model\Person object into a person string (Lastname, Firstname, Suffix).
     *
     * @param \Lakshay\Converter\Model\Person $person
     * @return string
     */
    private function getPerson(Person $person)
    {
        $return =   array($person->getFamily());

        if ($person->getGiven() !== '') {
            $return[]   =   $person->getGiven();
        }

        if ($person->getSuffix() !== '') {
            $return[]   =   $person->getSuffix();
        }

        return implode(', ', $return);
    }
}
