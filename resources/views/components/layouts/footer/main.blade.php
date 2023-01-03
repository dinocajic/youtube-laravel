<footer>
    <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <x-layouts.footer.logo-column page-title="{{ $attributes['page-title'] }}" />
            <div class="grid grid-cols-1 gap-8 lg:col-span-2 sm:grid-cols-2 lg:grid-cols-4">

                <x-layouts.footer.regular-column
                    column-title="Company"
                    :links="['/about' => 'About', '/meet-the-team' => 'Meet the Team', '/history' => 'History', '/careers' => 'Careers' ]"
                />

                <x-layouts.footer.regular-column
                    column-title="Services"
                    :links="['/company-review' => 'Company Review', '/accounts-review' => 'Accounts Review', '/hr-consulting' => 'HR Consulting' ]"
                />

                <x-layouts.footer.regular-column
                    column-title="Helpful Links"
                    :links="['/contact' => 'Contact', '/faqs' => 'FAQs', '/live-chat' => 'Live Chat' ]"
                />

                <x-layouts.footer.regular-column
                    column-title="Legal"
                    :links="['/privacy' => 'Privacy Policy', '/faqs' => 'FAQs', 'terms' => 'Terms & Conditions', '/returns' => 'Returns Policy', 'accessibility' => 'Accessibility' ]"
                />

            </div>
        </div>
        <p class="mt-8 text-xs text-gray-800">
            © 2023 Comany Name
        </p>
    </div>
</footer>
