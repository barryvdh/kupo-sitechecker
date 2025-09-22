@php use App\Rules\Levels; @endphp
<section class="w-full">

    <form wire:submit="checkSite" class="my-6 w-full space-y-6">

        <div>
            <flux:input wire:model="url" :label="__('Url')" type="url" required autofocus autocomplete="url"/>

        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full">{{ __('Check now') }}</flux:button>
            </div>

            <x-action-message class="me-3" on="site-checked">
                {{ __('Check.') }}
            </x-action-message>


        </div>
    </form>

    @if($result)
        <div class="checkResult">
            <table class="table-auto border-spacing-2 ">
                <tbody>
                @foreach($result as $check)
                    <tr>
                        <td class="align-top text-left">
                            @if($check['passed'])
                                <flux:icon.check-circle class="text-green-600 dark:text-green-600"/>
                            @elseif($check['level'] == Levels::NOTICE)
                                <flux:icon.information-circle class="text-blue-500 dark:text-blue-500"/>
                            @elseif($check['level'] == Levels::WARNING)
                                <flux:icon.exclamation-circle  class="text-orange-400 dark:text-orange-400"/>
                            @elseif($check['level'] == Levels::ERROR)
                                <flux:icon.x-circle  class="text-red-6700 dark:text-red-600"/>
                            @elseif($check['level'] == Levels::CRITICAL)
                                <flux:icon.x-circle variant="solid" class="text-red-800 dark:text-red-800"/>
                            @endif
                            </td>
                        <td class="align-top text-left">
                            {!! $check['message']  !!}
                            <small>{!! $check['help']  !!}</small>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    @endif

</section>
