# To learn more about how to use Nix to configure your environment
# see: https://developers.google.com/idx/guides/customize-idx-env
{pkgs}: {
  # Which nixpkgs channel to use.
  channel = "stable-24.05"; # or "unstable"
  # Use https://search.nixos.org/packages to find packages
  packages = [
    pkgs.php82
    pkgs.php82Packages.composer
    pkgs.nodejs_20
    pkgs.nodePackages.pnpm
    pkgs.sqlite
  ];
  # Sets environment variables in the workspace
  env = {};
  idx = {
    # Search for the extensions you want on https://open-vsx.org/ and use "publisher.id"
    extensions = [
      # Meta
      "vscodevim.vim"

      # Project
      "bmewburn.vscode-intelephense-client"
      "MehediDracula.php-namespace-resolver"
      "EditorConfig.EditorConfig"
      "onecentlin.laravel5-snippets"
      "ryannaddy.laravel-artisan"
      "amiralizadeh9480.laravel-extra-intellisense"
      "shufo.vscode-blade-formatter"
      "cjhowe7.laravel-blade"
      "d9705996.tighten-lint"
      "onecentlin.laravel-extension-pack"
      "bradlc.vscode-tailwindcss"
    ];
    workspace = {
      # Runs when a workspace is first created with this `dev.nix` file
      onCreate = {
        composer-install = "composer install";
        pnpm-install = "pnpm i && pnpm build";
      };
      # To run something each time the workspace is (re)started, use the `onStart` hook
    };
    # Enable previews and customize configuration
    previews = {
      enable = true;
      previews = {
        web = {
          command = ["php" "artisan" "serve" "--port" "$PORT" "--host" "0.0.0.0"];
          manager = "web";
        };
      };
    };
  };
}
