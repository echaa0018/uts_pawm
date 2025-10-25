<div class="relative min-h-screen flex items-center justify-center px-4 overflow-hidden"
style="background-image: url('/image/houshou_background2.png'); background-size: cover; background-position: center; background-repeat: no-repeat;"
>
  <!-- Motif background SVG -->
  {{-- <div class="absolute inset-0 -z-10 opacity-20">
    <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" fill="none" viewBox="0 0 1200 800">
      <defs>
        <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
          <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
        </pattern>
      </defs>
      <rect width="1200" height="800" fill="url(#grid)" />
    </svg>
  </div> --}}

  <!-- Login Card -->
  <div class="w-full max-w-5xl grid grid-cols-1  md:grid-cols-2 shadow-2xl rounded-2xl overflow-hidden border border-white/10 backdrop-blur-xl bg-white/20">
    
    <!-- Left Branding -->
    <div class="hidden md:flex flex-col justify-center items-start p-10 bg-white/10 text-white space-y-4">
      <div class="flex items-center gap-3">
        <img src="/image/houshou_icon.jpg" alt="Houshou Icon" class="w-12 h-12 rounded-lg object-cover">
        <h2 class="text-4xl font-bold">Welcome to Houshou</h2>
      </div>
      <p class="text-white/80">
        Your educational management platform. Learn, teach, and manage education efficiently.
      </p>
      <ul class="text-sm space-y-1 text-white/70">
        <li>✓ Secure and fast login</li>
        <li>✓ Student & teacher management</li>
        <li>✓ Integrated learning platform</li>
      </ul>
    </div>

    <!-- Right Login Form -->
    <div class="bg-white/50 backdrop-blur-lg text-white p-8">
      <div class="mb-3">
        {{-- <div class="text-left text-3xl font-semibold">Assentral</div> --}}
        {{-- <p class="text-sm text-black/80 mt-1">Sign in to your account</p> --}}
      </div>

      <form wire:submit.prevent="login" class="space-y-4">
        <x-input
          label="Email"
          type="email"
          wire:model.defer="email"
          {{-- placeholder="your@email.com" --}}
          icon="o-envelope"
          {{-- hint="Enter your registered email" --}}
          class="w-full text-black"
          required
        />

        {{-- <x-input
          label="Password"
          type="password"
          wire:model.defer="password"
          placeholder="••••••••"
          icon="o-lock-closed"
          class="w-full text-black"
          required
        /> --}}
        <x-password label="Password" class="w-full text-black" wire:model="password" left required />

        <x-button
          label="Login"
          type="submit"
          class="w-full btn-primary  text-white font-bold tracking-wide shadow-md"
          spinner="login"
        />
      </form>
    </div>
  </div>
</div>