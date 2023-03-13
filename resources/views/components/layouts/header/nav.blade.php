<nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
    <x-breakdown.header.nav-button
        nav-title="Blog"
        nav-link="/blog"
        selected="yes"
    />

    <x-breakdown.header.nav-button nav-title="Portfolio" nav-link="/portfolio" />
    <x-breakdown.header.nav-button nav-title="About" nav-link="/about" />
    <x-breakdown.header.nav-button nav-title="Contact" nav-link="/contact" />

    <x-breakdown.header.nav-dropdown />
</nav>
