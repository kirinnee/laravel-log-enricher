{ nixpkgs ? import <nixpkgs> { } }:
let pkgs = import ./packages.nix { inherit nixpkgs; }; in
with pkgs;
{
  system = [
    coreutils
    gnugrep
  ];

  dev = [
    phpstorm
    git
  ];

  main = [
    php
    composer
    pls
    docker
    awscli2
    mysql57
    openjdk
    jq
    nodejs
    gnused
  ];
  ci = [
  ];
  lint = [
    pre-commit
    nixpkgs-fmt
    prettier
    shfmt
    shellcheck
    hadolint
    php-cs-fixer
  ];

  ops = [
    kube3d
    kubernetes-helm
  ];

}
