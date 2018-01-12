<?php

namespace InterExcludeCategory\Model\Base;

use \Exception;
use \PDO;
use InterExcludeCategory\Model\InterExcludeCategory as ChildInterExcludeCategory;
use InterExcludeCategory\Model\InterExcludeCategoryQuery as ChildInterExcludeCategoryQuery;
use InterExcludeCategory\Model\Map\InterExcludeCategoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Thelia\Model\Category;

/**
 * Base class that represents a query for the 'inter_exclude_category' table.
 *
 *
 *
 * @method     ChildInterExcludeCategoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildInterExcludeCategoryQuery orderByFirstCategoryId($order = Criteria::ASC) Order by the first_category_id column
 * @method     ChildInterExcludeCategoryQuery orderBySecondCategoryId($order = Criteria::ASC) Order by the second_category_id column
 * @method     ChildInterExcludeCategoryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildInterExcludeCategoryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildInterExcludeCategoryQuery groupById() Group by the id column
 * @method     ChildInterExcludeCategoryQuery groupByFirstCategoryId() Group by the first_category_id column
 * @method     ChildInterExcludeCategoryQuery groupBySecondCategoryId() Group by the second_category_id column
 * @method     ChildInterExcludeCategoryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildInterExcludeCategoryQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildInterExcludeCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInterExcludeCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInterExcludeCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInterExcludeCategoryQuery leftJoinCategoryRelatedByFirstCategoryId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryRelatedByFirstCategoryId relation
 * @method     ChildInterExcludeCategoryQuery rightJoinCategoryRelatedByFirstCategoryId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryRelatedByFirstCategoryId relation
 * @method     ChildInterExcludeCategoryQuery innerJoinCategoryRelatedByFirstCategoryId($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryRelatedByFirstCategoryId relation
 *
 * @method     ChildInterExcludeCategoryQuery leftJoinCategoryRelatedBySecondCategoryId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryRelatedBySecondCategoryId relation
 * @method     ChildInterExcludeCategoryQuery rightJoinCategoryRelatedBySecondCategoryId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryRelatedBySecondCategoryId relation
 * @method     ChildInterExcludeCategoryQuery innerJoinCategoryRelatedBySecondCategoryId($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryRelatedBySecondCategoryId relation
 *
 * @method     ChildInterExcludeCategory findOne(ConnectionInterface $con = null) Return the first ChildInterExcludeCategory matching the query
 * @method     ChildInterExcludeCategory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInterExcludeCategory matching the query, or a new ChildInterExcludeCategory object populated from the query conditions when no match is found
 *
 * @method     ChildInterExcludeCategory findOneById(int $id) Return the first ChildInterExcludeCategory filtered by the id column
 * @method     ChildInterExcludeCategory findOneByFirstCategoryId(int $first_category_id) Return the first ChildInterExcludeCategory filtered by the first_category_id column
 * @method     ChildInterExcludeCategory findOneBySecondCategoryId(int $second_category_id) Return the first ChildInterExcludeCategory filtered by the second_category_id column
 * @method     ChildInterExcludeCategory findOneByCreatedAt(string $created_at) Return the first ChildInterExcludeCategory filtered by the created_at column
 * @method     ChildInterExcludeCategory findOneByUpdatedAt(string $updated_at) Return the first ChildInterExcludeCategory filtered by the updated_at column
 *
 * @method     array findById(int $id) Return ChildInterExcludeCategory objects filtered by the id column
 * @method     array findByFirstCategoryId(int $first_category_id) Return ChildInterExcludeCategory objects filtered by the first_category_id column
 * @method     array findBySecondCategoryId(int $second_category_id) Return ChildInterExcludeCategory objects filtered by the second_category_id column
 * @method     array findByCreatedAt(string $created_at) Return ChildInterExcludeCategory objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildInterExcludeCategory objects filtered by the updated_at column
 *
 */
abstract class InterExcludeCategoryQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \InterExcludeCategory\Model\Base\InterExcludeCategoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\InterExcludeCategory\\Model\\InterExcludeCategory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInterExcludeCategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInterExcludeCategoryQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \InterExcludeCategory\Model\InterExcludeCategoryQuery) {
            return $criteria;
        }
        $query = new \InterExcludeCategory\Model\InterExcludeCategoryQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildInterExcludeCategory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = InterExcludeCategoryTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InterExcludeCategoryTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildInterExcludeCategory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, FIRST_CATEGORY_ID, SECOND_CATEGORY_ID, CREATED_AT, UPDATED_AT FROM inter_exclude_category WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildInterExcludeCategory();
            $obj->hydrate($row);
            InterExcludeCategoryTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildInterExcludeCategory|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InterExcludeCategoryTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InterExcludeCategoryTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(InterExcludeCategoryTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(InterExcludeCategoryTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InterExcludeCategoryTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the first_category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstCategoryId(1234); // WHERE first_category_id = 1234
     * $query->filterByFirstCategoryId(array(12, 34)); // WHERE first_category_id IN (12, 34)
     * $query->filterByFirstCategoryId(array('min' => 12)); // WHERE first_category_id > 12
     * </code>
     *
     * @see       filterByCategoryRelatedByFirstCategoryId()
     *
     * @param     mixed $firstCategoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function filterByFirstCategoryId($firstCategoryId = null, $comparison = null)
    {
        if (is_array($firstCategoryId)) {
            $useMinMax = false;
            if (isset($firstCategoryId['min'])) {
                $this->addUsingAlias(InterExcludeCategoryTableMap::FIRST_CATEGORY_ID, $firstCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($firstCategoryId['max'])) {
                $this->addUsingAlias(InterExcludeCategoryTableMap::FIRST_CATEGORY_ID, $firstCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InterExcludeCategoryTableMap::FIRST_CATEGORY_ID, $firstCategoryId, $comparison);
    }

    /**
     * Filter the query on the second_category_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySecondCategoryId(1234); // WHERE second_category_id = 1234
     * $query->filterBySecondCategoryId(array(12, 34)); // WHERE second_category_id IN (12, 34)
     * $query->filterBySecondCategoryId(array('min' => 12)); // WHERE second_category_id > 12
     * </code>
     *
     * @see       filterByCategoryRelatedBySecondCategoryId()
     *
     * @param     mixed $secondCategoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function filterBySecondCategoryId($secondCategoryId = null, $comparison = null)
    {
        if (is_array($secondCategoryId)) {
            $useMinMax = false;
            if (isset($secondCategoryId['min'])) {
                $this->addUsingAlias(InterExcludeCategoryTableMap::SECOND_CATEGORY_ID, $secondCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($secondCategoryId['max'])) {
                $this->addUsingAlias(InterExcludeCategoryTableMap::SECOND_CATEGORY_ID, $secondCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InterExcludeCategoryTableMap::SECOND_CATEGORY_ID, $secondCategoryId, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(InterExcludeCategoryTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(InterExcludeCategoryTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InterExcludeCategoryTableMap::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(InterExcludeCategoryTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(InterExcludeCategoryTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InterExcludeCategoryTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Thelia\Model\Category object
     *
     * @param \Thelia\Model\Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function filterByCategoryRelatedByFirstCategoryId($category, $comparison = null)
    {
        if ($category instanceof \Thelia\Model\Category) {
            return $this
                ->addUsingAlias(InterExcludeCategoryTableMap::FIRST_CATEGORY_ID, $category->getId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InterExcludeCategoryTableMap::FIRST_CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategoryRelatedByFirstCategoryId() only accepts arguments of type \Thelia\Model\Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryRelatedByFirstCategoryId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function joinCategoryRelatedByFirstCategoryId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryRelatedByFirstCategoryId');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'CategoryRelatedByFirstCategoryId');
        }

        return $this;
    }

    /**
     * Use the CategoryRelatedByFirstCategoryId relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryRelatedByFirstCategoryIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryRelatedByFirstCategoryId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryRelatedByFirstCategoryId', '\Thelia\Model\CategoryQuery');
    }

    /**
     * Filter the query by a related \Thelia\Model\Category object
     *
     * @param \Thelia\Model\Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function filterByCategoryRelatedBySecondCategoryId($category, $comparison = null)
    {
        if ($category instanceof \Thelia\Model\Category) {
            return $this
                ->addUsingAlias(InterExcludeCategoryTableMap::SECOND_CATEGORY_ID, $category->getId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InterExcludeCategoryTableMap::SECOND_CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategoryRelatedBySecondCategoryId() only accepts arguments of type \Thelia\Model\Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryRelatedBySecondCategoryId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function joinCategoryRelatedBySecondCategoryId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryRelatedBySecondCategoryId');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'CategoryRelatedBySecondCategoryId');
        }

        return $this;
    }

    /**
     * Use the CategoryRelatedBySecondCategoryId relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Thelia\Model\CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryRelatedBySecondCategoryIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryRelatedBySecondCategoryId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryRelatedBySecondCategoryId', '\Thelia\Model\CategoryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildInterExcludeCategory $interExcludeCategory Object to remove from the list of results
     *
     * @return ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function prune($interExcludeCategory = null)
    {
        if ($interExcludeCategory) {
            $this->addUsingAlias(InterExcludeCategoryTableMap::ID, $interExcludeCategory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the inter_exclude_category table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InterExcludeCategoryTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InterExcludeCategoryTableMap::clearInstancePool();
            InterExcludeCategoryTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildInterExcludeCategory or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildInterExcludeCategory object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InterExcludeCategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InterExcludeCategoryTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        InterExcludeCategoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            InterExcludeCategoryTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(InterExcludeCategoryTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(InterExcludeCategoryTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(InterExcludeCategoryTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(InterExcludeCategoryTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(InterExcludeCategoryTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildInterExcludeCategoryQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(InterExcludeCategoryTableMap::CREATED_AT);
    }

} // InterExcludeCategoryQuery
