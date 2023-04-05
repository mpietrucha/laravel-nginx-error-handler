<?php

namespace Mpietrucha\Nginx\Error\Factory;

use Mpietrucha\Nginx\Error\Assets\Output as Driver;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;
use Mpietrucha\Support\Concerns\HasFactory;
use Illuminate\Filesystem\FilesystemAdapter;

class Output
{
    use HasFactory;

    protected ?FilesystemAdapter $disk = null;

    protected const INDICATOR = 'request';

    public function __construct(protected ?string $file = null, protected ?string $content = null)
    {
    }

    public function enshure(): void
    {
        if (! $this->file || ! $this->content) {
            return;
        }

        $this->disk->put(
            collect([self::INDICATOR, $this->file])->toWords()->snake(), $this->content
        );
    }

    public function clear(): void
    {
        $this->disk()
            ->collectAllFiles()
            ->filter(fn (SplFileInfo $file) => str($file->getFileName())->startsWith(self::INDICATOR))
            ->each(fn (SplFileInfo $file) => File::delete($file->getRealPath()));
    }

    protected function disk(): FilesystemAdapter
    {
        return $this->disk ??= Driver::create()->disk();
    }
}
