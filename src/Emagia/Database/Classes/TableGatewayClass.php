<?php

namespace Emagia\Database\Classes;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\TableGateway\Feature\AbstractFeature;
use Laminas\Db\TableGateway\Feature\FeatureSet;
use Laminas\Db\TableGateway\Exception\InvalidArgumentException;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\ResultSet\AbstractResultSet as AbstractResultSet;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\TableIdentifier;


use function is_array;
use function is_string;

class TableGatewayClass extends AbstractTableGateway
{
    /**
     * Constructor
     *
     * @param string|TableIdentifier|array $table
     * @param Feature\AbstractFeature|Feature\FeatureSet|Feature\AbstractFeature[]|null $features
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(
        $table,
        AdapterInterface $adapter,
        $features = null,
        ?AbstractResultSet $resultSetPrototype = null,
        ?Sql $sql = null
    ) {
        // table
        if (!(is_string($table) || $table instanceof TableIdentifier || is_array($table))) {
            throw new InvalidArgumentException(
                'Table name must be a string or an instance of Laminas\Db\Sql\TableIdentifier'
            );
        }
        $this->table = $table;

        // adapter
        $this->adapter = $adapter;

        // process features
        if ($features !== null) {
            if ($features instanceof AbstractFeature) {
                $features = [$features];
            }
            if (is_array($features)) {
                $this->featureSet = new FeatureSet($features);
            } elseif ($features instanceof FeatureSet) {
                $this->featureSet = $features;
            } else {
                throw new InvalidArgumentException(
                    'TableGateway expects $feature to be an instance of an AbstractFeature or a FeatureSet, or an '
                        . 'array of AbstractFeatures'
                );
            }
        } else {
            $this->featureSet = new FeatureSet();
        }

        // result prototype
        $this->resultSetPrototype = $resultSetPrototype ?: new ResultSet();

        // Sql object (factory for select, insert, update, delete)
        $this->sql = $sql ?: new Sql($this->adapter, $this->table);

        // check sql object bound to same table
        if ($this->sql->getTable() !== $this->table) {
            throw new InvalidArgumentException(
                'The table inside the provided Sql object must match the table of this TableGateway'
            );
        }

        $this->initialize();
    }
}
