<div class="fixed right-5 top-30">
    <a href="{{ route('bookmarks.index') }}" class="px-4 py-2 bg-primary rounded-full relative">
        <i class="fa-solid fa-bookmark text-xl text-gray-50 hover:text-gray-200 cursor-pointer"></i>
        <span class="absolute -top-3 right-0 bg-secondary px-2 py-0.5 rounded-full text-xs text-white font-medium">
            {{ $totalBookmarks }}
        </span>
    </a>
</div>
