<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:20
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Helper\EntityCollection;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;

class HobbyRepository
{
    protected $getByIdSql = '';

    protected $getBySql = '';

    protected $insertUploadedFileSql = '';

    protected $insertImageSql = '';

    protected $updateSql ='';

    protected $deleteSql = '';

    public function __construct( EntityManager $entityManager )
    {
        //$this->connection = new \PDO('','','');
        parent::__construct( $entityManager );
    }
    public function getById( int $id ) : EntityInterface
    {
        $statement = $this->connection->prepare( $this->getByIdSql );

        if( $statement->execute( [ 'id' => $id ] ))
        {
            $studentData = $statement->fetchAll( \PDO::FETCH_ASSOC );

            if( count( $studentData ) < 1)
            {
                return new Student();
            }

            return $this->createNewImage( $imageData[0] );
        }
    }

    public function getByCondition( $whereClause, $params ) : EntityCollection
    {

    }

    public function getOneByCondition( $whereClause, $params ) : EntityInterface
    {

    }

    public function insert( EntityInterface $entity )
    {

    }

    public function update( EntityInterface $entity )
    {

    }

    public function delete( int $id )
    {

    }
}