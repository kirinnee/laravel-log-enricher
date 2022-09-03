{ nixpkgs ? import <nixpkgs> { } }:
let
  pkgs = rec {
    atomi = (
      with import (fetchTarball "https://github.com/kirinnee/test-nix-repo/archive/refs/tags/v9.0.0.tar.gz");
      {
        inherit pls;
        phpstorm = jetbrains.phpstorm;
      }
    );
    "Composer Pin" = (
      with import (fetchTarball "https://github.com/NixOS/nixpkgs/archive/5e15d5da4abb74f0dd76967044735c70e94c5af1.tar.gz") { };
      rec {
        php74-composer = php74.buildEnv {
          extensions = ({ enabled, all }: enabled ++ (with all; [
            pcov
            redis
          ]));
          extraConfig = ''
            memory_limit=16G
          '';
        };
        composer = php74-composer.packages.composer;
      }
    );
    "Unstable 17th May 2022" = (
      with import (fetchTarball "https://github.com/NixOS/nixpkgs/archive/1d7db1b9e4cf.tar.gz") { };
      rec {
        inherit
          openjdk
          mysql57
          kube3d
          nodejs
          kubernetes-helm
          ;
        php-cs-fixer = php74Packages.php-cs-fixer;

        php = php74.buildEnv {
          extensions = ({ enabled, all }: enabled ++ (with all; [
            pcov
            xdebug
            redis
          ]));
          extraConfig = ''
            xdebug.start_with_request=yes
            xdebug.mode=debug
            pcov.directory=.
            pcov.exclude="~vendor~"
            memory_limit=16G
          '';
        };

        prettier = nodePackages.prettier;
      }
    );
    "Unstable 29th August 2022" = (
      with import (fetchTarball "https://github.com/NixOS/nixpkgs/archive/0e304ff0d9db453a4b230e9386418fd974d5804a.tar.gz") { };
      {
        inherit docker
          pre-commit
          git
          shfmt
          shellcheck
          nixpkgs-fmt
          bash
          hadolint
          coreutils
          jq
          awscli2
          gnused
          gnugrep;
      }


    );
  };
in
with pkgs;
pkgs.atomi // pkgs."Unstable 17th May 2022" // pkgs."Unstable 29th August 2022" // pkgs."Composer Pin"
