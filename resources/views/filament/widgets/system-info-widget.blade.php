<x-filament-widgets::widget>
    <x-filament::section>
        <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1rem; align-items: center;">
            @foreach ($items as $item)
                <div style="display: flex; align-items: center; gap: .75rem; min-width: 0;">
                    <div style="display: flex; width: 2.25rem; height: 2.25rem; flex: 0 0 2.25rem; align-items: center; justify-content: center; border-radius: .75rem; background: rgba(107, 114, 128, .12); color: rgb(107, 114, 128);">
                        @if ($item['icon'] === 'bolt')
                            <x-heroicon-o-bolt style="width: 1.25rem; height: 1.25rem;" />
                        @elseif ($item['icon'] === 'cube')
                            <x-heroicon-o-cube style="width: 1.25rem; height: 1.25rem;" />
                        @else
                            <x-heroicon-o-code-bracket style="width: 1.25rem; height: 1.25rem;" />
                        @endif
                    </div>

                    <div style="min-width: 0;">
                        <p style="margin: 0; font-size: .875rem; font-weight: 600; line-height: 1.25rem;">
                            {{ $item['label'] }}
                        </p>

                        <p style="margin: 0; font-size: .75rem; line-height: 1rem; color: rgb(107, 114, 128);">
                            {{ $item['displayValue'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <p style="margin: 1rem 0 0; font-size: .75rem; line-height: 1rem; color: rgb(156, 163, 175);">
            @if ($generatedAt)
                Actualizado: {{ $generatedAt }}
            @else
                Ejecuta <code>php artisan phpeitor:system-info</code> para guardar esta información.
            @endif
        </p>
    </x-filament::section>
</x-filament-widgets::widget>
