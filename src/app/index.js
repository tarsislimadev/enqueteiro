import { Server } from '@brtmvdl/backend'

const server = new Server()

server.get('/', (_, res) => res.setView('./views/index.html', { name: 'enqueteiro' }))

server.listen('80')
