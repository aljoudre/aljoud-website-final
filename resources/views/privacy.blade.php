@include('home.includes.head')

@include('home.includes.navbar')

@include('home.includes.sidebar')

    <!-- Privacy Policy Content -->
    <div class="max-w-4xl mx-auto px-4 md:px-8 py-12 md:py-16">
        <div class="bg-white rounded-lg shadow-lg p-6 md:p-10">
            @if($privacy)
                <h1 class="text-3xl md:text-4xl font-bold text-[#005A58] mb-8 text-center">{{ $privacy->translate('title') ?: 'سياسة الخصوصية' }}</h1>
                
                <div class="space-y-6 text-gray-700 leading-relaxed rtl prose prose-lg max-w-none">
                    {!! \Filament\Forms\Components\RichEditor\RichContentRenderer::make($privacy->translate('content'))->toHtml() !!}
                </div>

                <div class="border-t pt-6 mt-8">
                    <p class="text-sm text-gray-500">
                        <strong>آخر تحديث:</strong> {{ $privacy->updated_at->format('Y-m-d') }}
                    </p>
                </div>
            @else
                <h1 class="text-3xl md:text-4xl font-bold text-[#005A58] mb-8 text-center">سياسة الخصوصية</h1>
                <div class="text-center text-gray-500 py-8">
                    <p>لم يتم إعداد محتوى سياسة الخصوصية بعد.</p>
                    <p class="text-sm mt-2">يرجى إضافة المحتوى من لوحة التحكم.</p>
                </div>
            @endif
        </div>
    </div>

@include('home.includes.footer')

@include('home.includes.scripts')

