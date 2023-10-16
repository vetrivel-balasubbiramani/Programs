<?php
namespace Vendor1\Dump\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;

class Index extends Template
{
    protected $filesystem;
    protected $configFile;

    public function __construct(
        Template\Context $context,
        Filesystem $filesystem,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->filesystem = $filesystem;
        $this->configFile = 'config.php';
    }

    public function getConfigData()
    {
        $configFile = $this->filesystem->getDirectoryRead(DirectoryList::VAR_DIR)->getAbsolutePath('config_dump/' . $this->configFile);

        if (file_exists($configFile)) {
            $configData = include $configFile;
            return $configData;
        }

        return [];
    }

    public function getFormattedConfig()
    {
        $configData = $this->getConfigData();
        $formattedConfig = [];

        foreach ($configData as $parentKey => $parentValue) {
            if (is_array($parentValue)) {
                $formattedConfig = array_merge($formattedConfig, $this->flattenConfig($parentKey, $parentValue));
            } else {
                $formattedConfig[] = ['parent' => $parentKey, 'key' => $parentKey, 'value' => $parentValue];
            }
        }

        return $formattedConfig;
    }

    public function getToggleableConfig()
    {
        $formattedConfig = $this->getFormattedConfig();

        // Remove everything if the parent is 'modules'
        if (isset($formattedConfig['modules'])) {
            return [];
        }

        $toggleableConfig = array_filter($formattedConfig, function ($item) {
            return $this->isToggleableValue($item['value']);
        });

        return array_values($toggleableConfig); // Re-index the array
    }

    protected function flattenConfig($parent, $config, $formattedConfig = [])
    {
        foreach ($config as $key => $value) {
            if (is_array($value)) {
                $formattedConfig = array_merge($formattedConfig, $this->flattenConfig("$parent:$key", $value));
            } else {
                $formattedConfig[] = ['parent' => $parent, 'key' => $key, 'value' => $value];
            }
        }

        return $formattedConfig;
    }

    protected function isToggleableValue($value)
    {
        // Check if the value is exactly '0' or '1'
        return $value === '0' || $value === '1';
    }
}
