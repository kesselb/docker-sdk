#!/bin/bash

CACHE_DIRECTORY_NAME=".docker-sdk"
CACHE_DIRECTORY="${HOME}/${CACHE_DIRECTORY_NAME}"

function Cache::setup() {
  if [ ! -d "${CACHE_DIRECTORY}" ]; then
      mkdir "${CACHE_DIRECTORY}"
  fi
}

function Cache::load() {
  rm -rf "${1}/${CACHE_DIRECTORY_NAME}"
  cp -R "${CACHE_DIRECTORY}" "${1}"
}

function Cache::upload() {
  rm -rf "${CACHE_DIRECTORY}"
  cp -R "${DEPLOYMENT_PATH}/${CACHE_DIRECTORY_NAME}" "${HOME}"
}

Registry::Flow::addAfterUp 'Cache::upload'
