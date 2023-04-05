<?php

namespace Mpietrucha\Nginx\Error;

use Mpietrucha\Nginx\Error\Disk\Interceptor as Disk;
use Mpietrucha\Support\Concerns\HasFactory;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\FilesystemAdapter;
use Symfony\Component\Finder\SplFileInfo;
use Carbon\Carbon;

class Interceptor
{
    use HasFactory;

    protected ?FilesystemAdapter $disk = null;

    public function __construct(protected Response $response)
    {
        $this->handle();
    }

    protected function handle(): void
    {
        $this->clear();

        if (! $error = $this->intercepting()) {
            return;
        }

        $this->disk()->put(...$error);
    }

    protected function disk(): FilesystemAdapter
    {
        return $this->disk ??= Disk::create()->adapter();
    }

    protected function intercepting(): ?array
    {
        if (! $header = config('nginx.request.header')) {
            return null;
        }

        if (! $requestId = $response->headers->get($header)) {
            return null;
        }

        if (! $content = $response->getContent()) {
            return null;
        }

        return [$requestId, $content];
    }

    protected function clear(): void
    {
        $queue = $this->disk()->collectAllFiles()->filter($this->shouldDeleteInterceptor(...));

        $queue->each(fn (SplFileInfo $file) => File::delete($file->getRealPath()));
    }

    protected function shouldDeleteInterceptor(SplFileInfo $file): bool
    {
        $minutes = config('nginx.interceptors.lifetime');

        $fileLastAccessTime = Carbon::createFromTimestamp($file->getATime());

        return $fileLastAccessTime->addMinutes($minutes)->isAfter(Carbon::now());
    }
}
