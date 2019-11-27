<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification;

use PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification\PayDaySpecificationInterface;

interface PayClassification
{
    public function getPayDaySpecification(): PayDaySpecificationInterface;

    /** FIXME: 時給・固定給など異なる値を返す実装なので直してくれ〜〜 */
    public function getRate(): int;
}
