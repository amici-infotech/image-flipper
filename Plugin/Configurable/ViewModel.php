<?php
namespace Amici\ImageFlipper\Plugin\Configurable;

use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Class Configuration View Model
 */
class ViewModel
{
    /**
     * Key `view_model`
     */
    private const VIEW_MODEL = 'view_model';

    /**
     * @var ArgumentInterface
     */
    private ArgumentInterface $viewModel;

    /**
     * View Model Construct
     *
     * @param ArgumentInterface $viewModel
     */
    public function __construct(ArgumentInterface $viewModel)
    {
        $this->viewModel = $viewModel;
    }

    /**
     * Sets the view model before rendering to HTML
     *
     * @param DataObject $block
     * @return DataObject|null
     */
    public function beforeToHtml(DataObject $block): ?DataObject
    {
        if (!$block->hasData(self::VIEW_MODEL)) {
            $block->setData(self::VIEW_MODEL, $this->viewModel);
        }
        return null;
    }
}
