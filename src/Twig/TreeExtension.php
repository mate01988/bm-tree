<?php

declare(strict_types=1);

namespace App\Twig;

use App\Entity\User;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TreeExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('print_tree', [$this, 'printTree'], ['is_safe' => ['html']]),
        ];
    }

    public function printTree($tree)
    {
        return $this->printNode(0, $tree);
    }

    private function printNode(int $parentId, &$tree)
    {

        $html = '<ul>';

        /**
         * @var User $node
         */
        foreach ($tree[$parentId] as $nodeId => $node) {
            $html .= '<li class="' . ($node->isLeft() ? 'is-left' : '') . '">';
            $html .= '<a href="#" title="LC: '.$node->getCreditsLeft().', RC: '.$node->getCreditsRight().'">'.$node->getName().'</a>';

            if (isset($tree[$node->getId()])) {
                $html .= $this->printNode($node->getId(), $tree);
            }

            $html .= '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}