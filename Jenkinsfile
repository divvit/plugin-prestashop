node {
  stage 'Checkout'
  checkout scm

  stage 'Build'
  if (env.BRANCH_NAME == 'master') {
    env.VERSION = sh('./version.sh')
    sh './build.sh'
    sh 'ls ./build'
    sh 'git tag ${env.VERSION}'
    sh 'git push --tags'
  }
}
