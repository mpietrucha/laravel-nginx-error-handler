<?php

namespace Mpietrucha\Nginx\Error;

use Mpietrucha\Nginx\Error\Disk\Interceptor as Disk;
use Mpietrucha\Support\Concerns\HasFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;
use Carbon\Carbon;

class Interceptor
{
    use HasFactory;

    public function __construct(protected Request $request, protected Response $response)
    {
        $this->handle();
    }

    protected function handle(): void
    {
        $this->clear();

        if (! $error = $this->intercepting()) {
            return;
        }

        Disk::create()->put(...$error);
    }

    protected function intercepting(): ?array
    {
        if (! $header = config('nginx.request.header')) {
            return null;
        }

        if (! $requestId = $this->request->headers->get($header)) {
            return null;
        }

        if (! $content = $this->response->getContent()) {
            return null;
        }

        return [$requestId, $content];
    }

    protected function clear(): void
    {
        $queue = Disk::create()->adapter()->collectAllFiles()->filter($this->shouldDeleteInterceptor(...));

        $queue->each(fn (SplFileInfo $file) => File::delete($file->getRealPath()));
    }

    protected function shouldDeleteInterceptor(SplFileInfo $file): bool
    {
        $minutes = config('nginx.interceptors.lifetime');

        $fileLastAccessTime = Carbon::createFromTimestamp($file->getATime());

        return $fileLastAccessTime->addMinutes($minutes)->isAfter(Carbon::now());
    }
}
