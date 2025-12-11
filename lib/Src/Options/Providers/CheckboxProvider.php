<?php

namespace Base\Module\Src\Options\Providers;

use Base\Module\Src\Options\Interface\OptionProvider;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Config\Option;

class CheckboxProvider implements OptionProvider
{
    public function getType(): string
    {
        return 'checkbox';
    }

    public function render(array $option, string $moduleId): string
    {
        $defaultValue = $option['params']['default'] ?? 'N';
        $currentValue = Option::get($moduleId, $option['id'], $defaultValue);

        $isChecked = ($currentValue === 'Y') ? ' checked' : '';

        $html = '<tr>';
        $html .= '<td class="adm-detail-content-cell-l" width="50%">' . htmlspecialcharsbx($option['name']) . ':</td>';
        $html .= '<td class="adm-detail-content-cell-r" width="50%">';

        $html .= '<input type="hidden" name="' . htmlspecialcharsbx($option['id']) . '" value="N">';
        $html .= '<input type="checkbox" name="' . htmlspecialcharsbx($option['id']) . '" value="Y"' . $isChecked . '>';

        $html .= '</td>';
        $html .= '</tr>';
        return $html;
    }

    /**
     * @throws ArgumentOutOfRangeException
     */
    public function save(array $option, string $moduleId, mixed $value): void
    {
        $valueToSave = ($value === 'Y') ? 'Y' : 'N';
        Option::set($moduleId, $option['id'], $valueToSave);
    }
    
    public function getParamsToArray(): array
    {
        return [];
    }
}
