<div class="space-y-8">
    {{-- Hero Section --}}
    <div class="hero min-h-64 bg-gradient-to-br from-primary/20 via-secondary/20 to-accent/20 rounded-2xl">
        <div class="hero-content text-center">
            <div class="max-w-2xl">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    Welcome to Houshou Virtual Labs
                </h1>
                <p class="py-6 text-lg opacity-80">
                    Explore interactive physics, mathematics, and chemistry laboratories. 
                    Conduct experiments, solve equations, and discover the wonders of science.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('virtual-lab.index') }}" wire:navigate 
                       class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-primary to-secondary rounded-2xl shadow-2xl hover:shadow-primary/25 transition-all duration-500 hover:scale-105 hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-primary/30 focus:scale-105"
                       aria-label="Start exploring all virtual laboratories">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary to-secondary rounded-2xl blur opacity-30 group-hover:opacity-50 transition-opacity duration-500"></div>
                        <div class="relative flex items-center gap-3">
                            <svg class="w-6 h-6 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span>Start Exploring</span>
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </a>
                    
                    <a href="{{ route('virtual-lab.physics') }}" wire:navigate 
                       class="group relative inline-flex items-center justify-center px-6 py-4 text-lg font-semibold text-primary bg-white/10 backdrop-blur-sm border-2 border-primary/30 rounded-2xl hover:bg-primary hover:text-white hover:border-primary transition-all duration-500 hover:scale-105 hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-primary/30 focus:scale-105"
                       aria-label="Go directly to Physics Laboratory">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                            <span>Physics Lab</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Enhanced Statistics --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="stat bg-gradient-to-br from-primary/10 to-primary/5 border border-primary/20 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="stat-figure text-primary">
                <div class="avatar">
                    <div class="w-16 rounded-full bg-primary/20 p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-title text-primary/80">Total Experiment</div>
            <div class="stat-value text-primary">19</div>
            <div class="stat-desc">Across all labs</div>
        </div>

        <div class="stat bg-gradient-to-br from-secondary/10 to-secondary/5 border border-secondary/20 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="stat-figure text-secondary">
                <div class="avatar">
                    <div class="w-16 rounded-full bg-secondary/20 p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-title text-secondary/80">Math</div>
            <div class="stat-value text-secondary">6</div>
            <div class="stat-desc">Experiments</div>
        </div>

        <div class="stat bg-gradient-to-br from-accent/10 to-accent/5 border border-accent/20 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="stat-figure text-accent">
                <div class="avatar">
                    <div class="w-16 rounded-full bg-accent/20 p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-title text-accent/80">Physics</div>
            <div class="stat-value text-accent">6</div>
            <div class="stat-desc">Experiments</div>
        </div>

        <div class="stat bg-gradient-to-br from-info/10 to-info/5 border border-info/20 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="stat-figure text-info">
                <div class="avatar">
                    <div class="w-16 rounded-full bg-info/20 p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="stat-title text-info/80">Chemistry</div>
            <div class="stat-value text-info">7</div>
            <div class="stat-desc">Calculators</div>
        </div>
    </div>

    {{-- Lab Quick Access with Enhanced Design --}}
    <div class="card bg-base-100 shadow-2xl border border-base-300">
        <div class="card-body">
            <div class="flex items-center gap-3 mb-6">
                <div class="avatar">
                    <div class="w-12 rounded-full bg-primary/20 p-2">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="card-title text-2xl">Virtual Laboratory</h2>
                <div class="badge badge-primary badge-lg">Interactive</div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Overview Card --}}
                <a href="{{ route('virtual-lab.index') }}" wire:navigate class="group" aria-label="View all virtual laboratories overview">
                    <div class="relative overflow-hidden bg-gradient-to-br from-primary/5 to-primary/10 border border-primary/20 hover:border-primary/50 rounded-2xl shadow-lg hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative card-body text-center p-6">
                            <div class="avatar mx-auto mb-4">
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary/20 to-primary/30 p-4 group-hover:from-primary/30 group-hover:to-primary/40 transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                                    <svg class="w-10 h-10 text-primary group-hover:text-primary/90 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="font-bold text-xl text-primary group-hover:text-primary/90 mb-2 transition-colors duration-300">Overview</h3>
                            <div class="text-4xl font-bold text-primary my-3 group-hover:scale-110 transition-transform duration-300">3</div>
                            <p class="text-sm opacity-70 group-hover:opacity-90 transition-opacity duration-300">Available Labs</p>
                            <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="flex items-center justify-center gap-1 text-primary/60">
                                    <span class="text-xs">Explore All</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Physics Lab Card --}}
                <a href="{{ route('virtual-lab.physics') }}" wire:navigate class="group" aria-label="Go to Physics Laboratory">
                    <div class="relative overflow-hidden bg-gradient-to-br from-secondary/5 to-secondary/10 border border-secondary/20 hover:border-secondary/50 rounded-2xl shadow-lg hover:shadow-2xl hover:shadow-secondary/10 transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-secondary/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative card-body text-center p-6">
                            <div class="avatar mx-auto mb-4">
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-secondary/20 to-secondary/30 p-4 group-hover:from-secondary/30 group-hover:to-secondary/40 transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                                    <svg class="w-10 h-10 text-secondary group-hover:text-secondary/90 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="font-bold text-xl text-secondary group-hover:text-secondary/90 mb-2 transition-colors duration-300">Physics</h3>
                            <div class="text-4xl font-bold text-secondary my-3 group-hover:scale-110 transition-transform duration-300">6</div>
                            <p class="text-sm opacity-70 group-hover:opacity-90 transition-opacity duration-300">Experiments</p>
                            <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="flex items-center justify-center gap-1 text-secondary/60">
                                    <span class="text-xs">Start Lab</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Math Lab Card --}}
                <a href="{{ route('virtual-lab.math') }}" wire:navigate class="group" aria-label="Go to Mathematics Laboratory">
                    <div class="relative overflow-hidden bg-gradient-to-br from-accent/5 to-accent/10 border border-accent/20 hover:border-accent/50 rounded-2xl shadow-lg hover:shadow-2xl hover:shadow-accent/10 transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-accent/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative card-body text-center p-6">
                            <div class="avatar mx-auto mb-4">
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-accent/20 to-accent/30 p-4 group-hover:from-accent/30 group-hover:to-accent/40 transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                                    <svg class="w-10 h-10 text-accent group-hover:text-accent/90 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="font-bold text-xl text-accent group-hover:text-accent/90 mb-2 transition-colors duration-300">Math</h3>
                            <div class="text-4xl font-bold text-accent my-3 group-hover:scale-110 transition-transform duration-300">6</div>
                            <p class="text-sm opacity-70 group-hover:opacity-90 transition-opacity duration-300">Tools</p>
                            <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="flex items-center justify-center gap-1 text-accent/60">
                                    <span class="text-xs">Start Lab</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Chemistry Lab Card --}}
                <a href="{{ route('virtual-lab.chemistry') }}" wire:navigate class="group" aria-label="Go to Chemistry Laboratory">
                    <div class="relative overflow-hidden bg-gradient-to-br from-info/5 to-info/10 border border-info/20 hover:border-info/50 rounded-2xl shadow-lg hover:shadow-2xl hover:shadow-info/10 transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-info/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative card-body text-center p-6">
                            <div class="avatar mx-auto mb-4">
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-info/20 to-info/30 p-4 group-hover:from-info/30 group-hover:to-info/40 transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                                    <svg class="w-10 h-10 text-info group-hover:text-info/90 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="font-bold text-xl text-info group-hover:text-info/90 mb-2 transition-colors duration-300">Chemistry</h3>
                            <div class="text-4xl font-bold text-info my-3 group-hover:scale-110 transition-transform duration-300">7</div>
                            <p class="text-sm opacity-70 group-hover:opacity-90 transition-opacity duration-300">Calculators</p>
                            <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="flex items-center justify-center gap-1 text-info/60">
                                    <span class="text-xs">Start Lab</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- Feature Highlights --}}
    <div class="space-y-8">
        {{-- Quick Actions - Full Width --}}
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <div class="flex items-center gap-3 mb-6">
                    <div class="avatar">
                        <div class="w-12 rounded-full bg-success/20 p-2">
                            <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <h2 class="card-title text-2xl">Quick Actions</h2>
                    <div class="badge badge-success badge-lg">Interactive</div>
                </div>
                <div class="space-y-3">
                    <a href="{{ route('virtual-lab.math') }}" wire:navigate class="group block">
                        <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-primary/5 to-primary/10 border border-primary/20 rounded-xl hover:border-primary/40 hover:shadow-lg hover:shadow-primary/10 transition-all duration-300 group-hover:scale-[1.02] group-hover:-translate-y-1">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary/20 to-primary/30 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-6 h-6 text-primary group-hover:text-primary/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-lg group-hover:text-primary transition-colors duration-300">Solve Quadratic Equations</div>
                                <div class="text-sm opacity-70 group-hover:opacity-90 transition-opacity duration-300">Math Lab • Calculator</div>
                            </div>
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg class="w-5 h-5 text-primary/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                    
                    <a href="{{ route('virtual-lab.physics') }}" wire:navigate class="group block">
                        <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-secondary/10 to-secondary/15 border-2 border-secondary/30 rounded-xl hover:border-secondary/50 hover:shadow-lg hover:shadow-secondary/20 transition-all duration-300 group-hover:scale-[1.02] group-hover:-translate-y-1">
                            <div class="w-12 h-12 bg-gradient-to-br from-secondary/30 to-secondary/40 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-6 h-6 text-secondary group-hover:text-secondary transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-bold text-lg text-secondary group-hover:text-secondary transition-colors duration-300">Pendulum Experiment</div>
                                <div class="text-sm font-medium text-secondary/80 group-hover:text-secondary transition-opacity duration-300">Physics Lab • Motion</div>
                            </div>
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                    
                    <a href="{{ route('virtual-lab.chemistry') }}" wire:navigate class="group block">
                        <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-info/5 to-info/10 border border-info/20 rounded-xl hover:border-info/40 hover:shadow-lg hover:shadow-info/10 transition-all duration-300 group-hover:scale-[1.02] group-hover:-translate-y-1">
                            <div class="w-12 h-12 bg-gradient-to-br from-info/20 to-info/30 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-6 h-6 text-info group-hover:text-info/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-lg group-hover:text-info transition-colors duration-300">pH Calculator</div>
                                <div class="text-sm opacity-70 group-hover:opacity-90 transition-opacity duration-300">Chemistry Lab • Analysis</div>
                            </div>
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg class="w-5 h-5 text-info/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
