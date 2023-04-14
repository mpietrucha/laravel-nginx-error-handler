<?php

namespace Mpietrucha\Nginx\Error\Builder;

use Illuminate\Support\Collection;
use Mpietrucha\Nginx\Error\Factory\Builder;
use Symfony\Component\HttpFoundation\Request;
use Mpietrucha\Support\Concerns\HasVendor;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Illuminate\Foundation\Exceptions\Handler as DefaultLaravelErrorHandler;

class Error extends Builder
{
    use HasVendor;

    public function collection(): Collection
    {
        $handler = $this->handler();

        return collect_config('nginx.errors')->mapWithKeys(fn (int $status) => [
            "$status.html" => $this->build($status, $handler)
        ])->filter();
    }

    protected function build(int $status, DefaultLaravelErrorHandler $handler): ?string
    {
        try {
            abort($status);
        } catch (HttpExceptionInterface $e) {
            return app($handler)->render(new Request, $e)->getContent();
        }
    }

    protected function handler(): DefaultLaravelErrorHandler
    {
        $appErrorHandler = $this->vendor()->root()->namespace('exceptions', 'handler');

        if (! class_exists($appErrorHandler)) {
            return app(DefaultLaravelErrorHandler::class);
        }

        return app($appErrorHandler);
    }
}
