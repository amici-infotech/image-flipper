<?php
namespace Amici\ImageFlipper\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Source Values Of Flip Image Option
 */
class FlipImageOption implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => '0', 'label' => __('None')],
            ['value' => 'Y', 'label' => __('Horizontal')],
            ['value' => 'X', 'label' => __('Vertical')],
            ['value' => '1', 'label' => __('Rotate')]
        ];
    }
}
