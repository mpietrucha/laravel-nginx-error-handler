<?php

namespace Mpietrucha\Nginx\Error\Builder;

use Closure;
use Illuminate\Support\Collection;
use Mpietrucha\Nginx\Error\Factory\Builder;

class Nginx extends Builder
{
    protected const NAME = 'error.conf';

    protected const INTERCEPT = 'proxy_intercept_errors on;';

    public function collection(): Collection
    {
        return collect([
            self::NAME => $this->build()
        ]);
    }

    protected function build(): string
    {
        return collect_config('nginx.errors')->each($this->block(...))->prepend(self::INTERCEPT)->toNewLineWords();
    }

    protected function block(int $error): string
    {
        return collect([
            "error_page $error /$error.html;",
            collect([
                "location /$error.html", '{', 'try_files', $this->resolve('$request_id.html', "$error.html"), 'internal;', '}'
            ])->toWords()
        ])->toNewLineWords();
    }
}
