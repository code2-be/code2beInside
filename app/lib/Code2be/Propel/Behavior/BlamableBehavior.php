<?php

namespace Code2be\Propel\Behavior;

class BlamableBehavior extends \Behavior
{
    protected $parameters = array(
        'create_column' => 'created_by',
        'update_column' => 'updated_by',
    );

    public function modifyTable() {
        $table = $this->getTable();
        $createColumn = $this->getParameter('create_column');
        // add the column if not present
        if(!$this->getTable()->containsColumn($createColumn)) {
          $column = $this->getTable()->addColumn(array(
            'name'    => $createColumn,
            'type'    => 'INTEGER',
          ));
        }

        $updateColumn = $this->getParameter('update_column');
        // add the column if not present
        if(!$this->getTable()->containsColumn($updateColumn)) {
          $column = $this->getTable()->addColumn(array(
            'name'    => $updateColumn,
            'type'    => 'INTEGER',
          ));
        }

        $fk = new \ForeignKey();
        $fk->setForeignTableCommonName('user');
        $fk->setOnDelete(null);
        $fk->setOnUpdate(null);
        $fk->addReference($createColumn, 'id');
        $this->getTable()->addForeignKey($fk);

        $fk = new \ForeignKey();
        $fk->setForeignTableCommonName('user');
        $fk->setOnDelete(null);
        $fk->setOnUpdate(null);
        $fk->addReference($updateColumn, 'id');
        $this->getTable()->addForeignKey($fk);
    }
    protected function hasColumn($column) {
            return $this->getTable()->containsColumn($this->getParameter($column));
    }

    protected function getColumnConstant($columnName, $builder) {
            return $builder->getColumnConstant($this->getColumnForParameter($columnName));
    }

    protected function getColumnSetter($column) {
            return 'set' . $this->getColumnForParameter($column)->getPhpName();
    }

    protected function generateUserColumnValue($column) {
            return '\Code2be\Helper\Auth::getUser()->getId()';
    }

    public function preUpdate($builder) {
            if(!$this->hasColumn('update_column'))
                    return;
            return "if (\$this->isModified() && !\$this->isColumnModified(" . $this->getColumnConstant('update_column', $builder) . ")) {
    \$this->" . $this->getColumnSetter('update_column') . "(".$this->generateUserColumnValue('update_column').");
    }";
    }

    public function preInsert($builder) {
            $php = '';
            if($this->hasColumn('create_column')) {
                    $php .= "if (!\$this->isColumnModified(" . $this->getColumnConstant('create_column', $builder) . ")) {
    \$this->" . $this->getColumnSetter('create_column') . "(".$this->generateUserColumnValue('create_column').");
    }\n";
            }
            if($this->hasColumn('update_column')) {
                    $php .= "if (!\$this->isColumnModified(" . $this->getColumnConstant('update_column', $builder) . ")) {
    \$this->" . $this->getColumnSetter('update_column') . "(".$this->generateUserColumnValue('update_column').");
    }";
            }
            return $php;
    }
}
