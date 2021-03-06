<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 12:26
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Kernel\Database\Repository;

use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\EntityInterface;
use StendenINF1B\PortfolioCMS\Kernel\Database\Entity\Language;
use StendenINF1B\PortfolioCMS\Kernel\Database\EntityManager;
use StendenINF1B\PortfolioCMS\Kernel\Exception\RepositoryException;

class LanguageRepository extends Repository
{
    /**
     * This holds an SQL statement for selecting an Language entity from the database by its id.
     *
     * @var string
     */
    protected $getByIdSql = '
        SELECT
            `Language`.`id`,
            `Language`.`language`,
            `Language`.`level`,
            `Language`.`isNative`,
            `Language`.`portfolioId`
        FROM `DigitalPortfolio`.`Language`
        WHERE `Language`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for selecting an Language entity from the database.
     *
     * @var string
     */
    protected $getBySql = '
        SELECT
            `Language`.`id`,
            `Language`.`language`,
            `Language`.`level`,
            `Language`.`isNative`,
            `Language`.`portfolioId`
        FROM `DigitalPortfolio`.`Language`
    ';

    /**
     * This holds an SQL statement for inserting an new Language entity into the database.
     *
     * @var string
     */
    protected $insertLanguageSql = '
        INSERT INTO `DigitalPortfolio`.`Language`( 
            `language`,
            `level`,
            `isNative`,
            `portfolioId`
        ) VALUES ( 
            :language,
            :level,
            :isNative,
            :portfolioId
        );
    ';

    /**
     * This holds an SQL statement for updating an Language entity in the database.
     *
     * @var string
     */
    protected $updateLanguageSql = '
        UPDATE Language SET 
            `language` = :language,
            `level` = :level,
            `isNative` = :isNative,
            `portfolioId` = :portfolioId
        WHERE `Language`.`id` = :id;
    ';

    /**
     * This holds an SQL statement for deleting an Language entity from the database.
     *
     * @var string
     */
    protected $deleteSql = '
        DELETE FROM Language WHERE `Language`.`id` = :id;
    ';

    /**
     * LanguageRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct( EntityManager $entityManager )
    {
        parent::__construct( $entityManager );
    }

    /**
     * Inserts an new language in the database.
     *
     * @param Language $language
     * @return Language
     * @throws RepositoryException
     */
    public function insert( Language $language ) : Language
    {
        try
        {
            $statement = $this->connection->prepare( $this->insertLanguageSql );

            $statement->execute( [
                ':language'    => $language->getLanguage(),
                ':level'       => $language->getLevel(),
                ':isNative'    => (int)$language->getIsIsNative(),
                ':portfolioId' => (int)$language->getPortfolioId(),
            ] );

            $id = (int)$this->connection->lastInsertId();

            return $this->getById( $id );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The language could not be inserted: ' . $exception->getMessage() );
        }
    }

    /**
     * Updates an language in the database.
     *
     * @param Language $language
     * @return Language
     * @throws RepositoryException
     */
    public function update( Language $language ) : Language
    {
        try
        {
            $statement = $this->connection->prepare( $this->updateLanguageSql );

            $statement->execute( [
                ':language'    => $language->getLanguage(),
                ':level'       => $language->getLevel(),
                ':isNative'    => (int)$language->getIsIsNative(),
                ':portfolioId' => $language->getPortfolioId(),
                ':id'          => $language->getId(),
            ] );

            return $this->getById( $language->getId() );

        }
        catch ( \PDOException $exception )
        {
            throw new RepositoryException( 'The language could not be updated: ' . $exception->getMessage() );
        }
    }

    /**
     * Creates an new language object from data from the database.
     *
     * @param array $databaseData
     * @return EntityInterface
     */
    public function createEntity( array $databaseData ) : EntityInterface
    {
        $language = new Language();
        $language->setId( (int)$databaseData[ 'id' ] );
        $language->setLanguage( $databaseData[ 'language' ] );
        $language->setLevel( (int)$databaseData[ 'level' ] );
        $language->setIsNative( (bool)$databaseData[ 'isNative' ] );
        $language->setPortfolioId( (int)$databaseData[ 'portfolioId' ] );

        return $language;
    }

    /**
     * Creates an new language object.
     *
     * @return EntityInterface
     */
    public function createEmptyEntity() : EntityInterface
    {
        return new Language();
    }
}